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

use Ajgl\ValidatorEs\IbanValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(IbanValidator::class)]
final class IbanValidatorTest extends TestCase
{
    private IbanValidator $validator;

    protected function setUp(): void
    {
        if (!extension_loaded('gmp')) {
            $this->markTestSkipped(
                'The GMP extension is not available.'
            );
        }
        $this->validator = new IbanValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->assertTrue($this->validator->isValid($value));
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->assertFalse($this->validator->isValid($value));
    }

    public static function validValues(): \Iterator
    {
        yield ['ES5812345678010123456789'];
        yield ['ES8200000000000000000000'];
        yield ['ES8200010001650000000001'];
        yield ['ES1299999999509999999999'];
        yield ['ES7287654321510123456789'];
        yield ['ES3011112222003333333333'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['ES0812345678010123456789'];
        yield ['FR0000000000000000000000'];
        yield ['E58200010001650000000001'];
        yield ['ES12999999995099999999'];
        yield [['a']];
        yield [false];
        yield [null];
        yield [new \stdClass()];
    }
}
