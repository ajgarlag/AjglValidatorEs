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

namespace Ajgl\ValidatorEs\Tests\Symfony\Bridge\Validator\Constraints;

use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\Iban;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\IbanValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @extends ConstraintValidatorTestCase<IbanValidator>
 */
#[CoversClass(IbanValidator::class)]
final class IbanValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): IbanValidator
    {
        return new IbanValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->validator->validate($value, new Iban());

        $this->assertNoViolation();
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->validator->validate($value, new Iban());

        $this->buildViolation((new Iban())->message)->setCode(Iban::IS_INVALID_ERROR)->assertRaised();
    }

    public static function validValues(): \Iterator
    {
        yield ['ES5812345678010123456789'];
        yield ['ES8200000000000000000000'];
        yield ['Es8200010001650000000001'];
        yield ['eS1299999999509999999999'];
        yield ['ES7287654321510123456789'];
        yield ['es3011112222003333333333'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['ES0812345678010123456789'];
        yield ['FR0000000000000000000000'];
        yield ['E58200010001650000000001'];
        yield ['ES12999999995099999999'];
        yield [['a']];
        yield [false];
        yield [new \stdClass()];
    }
}
