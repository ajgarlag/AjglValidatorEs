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

use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\Nie;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\NieValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @extends ConstraintValidatorTestCase<NieValidator>
 */
#[CoversClass(NieValidator::class)]
final class NieValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): NieValidator
    {
        return new NieValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->validator->validate($value, new Nie());

        $this->assertNoViolation();
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->validator->validate($value, new Nie());

        $this->buildViolation((new Nie())->message)->setCode(Nie::IS_INVALID_ERROR)->assertRaised();
    }

    public static function validValues(): \Iterator
    {
        yield ['Y7313897A'];
        yield ['Z6141300Y'];
        yield ['X7972230Q'];
        yield ['Z3607453T'];
        yield ['X8248943Q'];
        yield ['z7950724C'];
        yield ['z2249875c'];
        yield ['z8532138v'];
        yield ['Y5742304t'];
        yield ['Y0739675d'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['34055333Y'];
        yield ['44085859K'];
        yield ['a1873322T'];
        yield ['Y3313897A'];
        yield ['Z7141300Y'];
        yield ['A8412892J'];
        yield ['zz2J'];
        yield ['l716V'];
        yield [['a']];
        yield [false];
        yield [new \stdClass()];
    }
}
