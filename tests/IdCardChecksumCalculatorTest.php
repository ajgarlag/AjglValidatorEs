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

use Ajgl\ValidatorEs\IdCardChecksumCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(IdCardChecksumCalculator::class)]
final class IdCardChecksumCalculatorTest extends TestCase
{
    private IdCardChecksumCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new IdCardChecksumCalculator();
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
        yield ['Y7313897', 'A'];
        yield ['Z6141300', 'Y'];
        yield ['X7972230', 'Q'];
        yield ['Z3607453', 'T'];
        yield ['X8248943', 'Q'];
        yield ['Z7950724', 'C'];
        yield ['Z2249875', 'C'];
        yield ['Z8532138', 'V'];
        yield ['Y5742304', 'T'];
        yield ['Y0739675', 'D'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['055333T'];
        yield ['085859G'];
        yield ['A853213'];
        yield ['zz2J'];
        yield ['l716V'];
    }
}
