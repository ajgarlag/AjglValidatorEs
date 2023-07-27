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
use PHPUnit\Framework\ExpectationFailedException;

/**
 * @extends ConstraintValidatorTestCase<IdCardValidator>
 * @covers IdCardValidator
 */
#[CoversClass(IdCardValidator::class)]
final class IdCardValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): IdCardValidator
    {
        return new IdCardValidator();
    }

    /**
     * @dataProvider validValues
     */
    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->validator->validate($value, new IdCard());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider invalidValues
     */
    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->validator->validate($value, new IdCard());

        $this->buildViolation((new IdCard())->message)->setCode(IdCard::IS_INVALID_ERROR)->assertRaised();
    }

    /**
     * @return list<list<string>>
     */
    public static function validValues(): iterable
    {
        yield from [
            ['44055333Y'],
            ['84085859K'],
            ['21873322T'],
            ['68412892J'],
            ['73779716V'],
            ['88819264a'],
            ['50623719y'],
            ['02288983t'],
            ['64932327s'],
            ['81532270f'],
            ['Y7313897A'],
            ['Z6141300Y'],
            ['X7972230Q'],
            ['Z3607453T'],
            ['X8248943Q'],
            ['z7950724C'],
            ['z2249875c'],
            ['z8532138v'],
            ['Y5742304t'],
            ['Y0739675d'],
        ];
    }

    /**
     * @return list<list<mixed>>
     */
    public static function invalidValues(): iterable
    {
        yield from [
            ['34055333Y'],
            ['44085859K'],
            ['Z7532138V'],
            ['34055333Y'],
            ['44085859K'],
            ['a1873322T'],
            ['Y3313897A'],
            ['Z7141300Y'],
            ['A8412892J'],
            ['zz2J'],
            ['l716V'],
            [['a']],
            [false],
            [new \stdClass()],
        ];
    }
}
