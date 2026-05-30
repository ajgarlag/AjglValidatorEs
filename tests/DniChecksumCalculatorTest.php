<?php

declare(strict_types=1);

/*
 * AJGL Validator ES
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\ValidatorEs\Tests;

use Ajgl\ValidatorEs\DniChecksumCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(DniChecksumCalculator::class)]
final class DniChecksumCalculatorTest extends TestCase
{
    private DniChecksumCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new DniChecksumCalculator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->assertTrue($this->calculator->isValid($value));
    }

    #[DataProvider('validValues')]
    public function testCalculatedChecksum(string $value, string $checksum): void
    {
        $this->assertSame($checksum, $this->calculator->calculateChecksum($value));
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(string $value): void
    {
        $this->assertFalse($this->calculator->isValid($value));
    }

    public static function validValues(): \Iterator
    {
        yield ['44055333', 'Y'];
        yield ['84085859', 'K'];
        yield ['21873322', 'T'];
        yield ['68412892', 'J'];
        yield ['73779716', 'V'];
        yield ['88819264', 'A'];
        yield ['50623719', 'Y'];
        yield ['02288983', 'T'];
        yield ['64932327', 'S'];
        yield ['81532270', 'F'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['4055333Y'];
        yield ['4085859K'];
        yield ['A8532138'];
        yield ['zz2J'];
        yield ['l716V'];
    }
}
