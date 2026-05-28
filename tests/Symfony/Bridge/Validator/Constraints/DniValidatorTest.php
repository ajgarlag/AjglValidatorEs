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

use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\Dni;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\DniValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @extends ConstraintValidatorTestCase<DniValidator>
 */
#[CoversClass(DniValidator::class)]
final class DniValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): DniValidator
    {
        return new DniValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->validator->validate($value, new Dni());

        $this->assertNoViolation();
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->validator->validate($value, new Dni());

        $this->buildViolation((new Dni())->message)->setCode(Dni::IS_INVALID_ERROR)->assertRaised();
    }

    public static function validValues(): \Iterator
    {
        yield ['44055333Y'];
        yield ['84085859K'];
        yield ['21873322T'];
        yield ['68412892J'];
        yield ['73779716V'];
        yield ['88819264a'];
        yield ['50623719y'];
        yield ['02288983t'];
        yield ['64932327s'];
        yield ['81532270f'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['34055333Y'];
        yield ['44085859K'];
        yield ['Z8532138V'];
        yield ['zz2J'];
        yield ['l716V'];
        yield [['a']];
        yield [false];
        yield [new \stdClass()];
    }
}
