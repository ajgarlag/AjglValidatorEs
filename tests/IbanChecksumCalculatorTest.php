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

use Ajgl\ValidatorEs\IbanChecksumCalculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(IbanChecksumCalculator::class)]
final class IbanChecksumCalculatorTest extends TestCase
{
    private IbanChecksumCalculator $calculator;

    protected function setUp(): void
    {
        if (!extension_loaded('gmp')) {
            $this->markTestSkipped(
                'The GMP extension is not available.'
            );
        }
        $this->calculator = new IbanChecksumCalculator();
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
        yield ['12345678010123456789', '58'];
        yield ['00000000000000000000', '82'];
        yield ['00010001650000000001', '82'];
        yield ['99999999509999999999', '12'];
        yield ['87654321510123456789', '72'];
        yield ['11112222003333333333', '30'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['123456780101234567'];
        yield ['00000000000000000001'];
        yield ['00010001650000000005'];
        yield ['111122220O3333333333'];
    }
}
