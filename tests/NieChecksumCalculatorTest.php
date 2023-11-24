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

use Ajgl\ValidatorEs\NieChecksumCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @covers NieChecksumCalculator
 */
#[CoversClass(NieChecksumCalculator::class)]
final class NieChecksumCalculatorTest extends TestCase
{
    private NieChecksumCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new NieChecksumCalculator();
    }

    /**
     * @dataProvider validValues
     */
    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        self::assertTrue($this->calculator->isValid($value));
    }

    /**
     * @dataProvider validValues
     */
    #[DataProvider('validValues')]
    public function testCalculatedChecksum(string $value, string $checksum): void
    {
        self::assertSame($checksum, $this->calculator->calculateChecksum($value));
    }

    /**
     * @dataProvider invalidValues
     */
    #[DataProvider('invalidValues')]
    public function testInvalidValues(string $value): void
    {
        self::assertFalse($this->calculator->isValid($value));
    }

    /**
     * @return \Iterator<array{0: string, 1: string}>
     */
    public static function validValues(): \Iterator
    {
        yield from [
            ['Y7313897', 'A'],
            ['Z6141300', 'Y'],
            ['X7972230', 'Q'],
            ['Z3607453', 'T'],
            ['X8248943', 'Q'],
            ['Z7950724', 'C'],
            ['Z2249875', 'C'],
            ['Z8532138', 'V'],
            ['Y5742304', 'T'],
            ['Y0739675', 'D'],
        ];
    }

    /**
     * @return \Iterator<list<string>>
     */
    public static function invalidValues(): \Iterator
    {
        yield from [
            ['4055333'],
            ['4085859'],
            ['A853213'],
            ['zz2J'],
            ['l716V'],
        ];
    }
}
