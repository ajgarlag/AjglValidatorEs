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

use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\IdCard;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\IdCardValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @extends ConstraintValidatorTestCase<IdCardValidator>
 */
#[CoversClass(IdCardValidator::class)]
final class IdCardValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): IdCardValidator
    {
        return new IdCardValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->validator->validate($value, new IdCard());

        $this->assertNoViolation();
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->validator->validate($value, new IdCard());

        $this->buildViolation((new IdCard())->message)->setCode(IdCard::IS_INVALID_ERROR)->assertRaised();
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
        yield ['Z7532138V'];
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
