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

    /**
     * @return \Iterator<array{0: string, 1: string}>
     */
    public static function validValues(): \Iterator
    {
        yield from [
            ['44055333', 'Y'],
            ['84085859', 'K'],
            ['21873322', 'T'],
            ['68412892', 'J'],
            ['73779716', 'V'],
            ['88819264', 'A'],
            ['50623719', 'Y'],
            ['02288983', 'T'],
            ['64932327', 'S'],
            ['81532270', 'F'],
        ];
    }

    /**
     * @return \Iterator<list<string>>
     */
    public static function invalidValues(): \Iterator
    {
        yield from [
            ['4055333Y'],
            ['4085859K'],
            ['A8532138'],
            ['zz2J'],
            ['l716V'],
        ];
    }
}
