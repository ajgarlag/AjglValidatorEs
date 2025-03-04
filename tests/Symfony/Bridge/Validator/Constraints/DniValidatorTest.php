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

    /**
     * @return \Iterator<list<string>>
     */
    public static function validValues(): \Iterator
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
        ];
    }

    /**
     * @return \Iterator<list<mixed>>
     */
    public static function invalidValues(): \Iterator
    {
        yield from [
            ['34055333Y'],
            ['44085859K'],
            ['Z8532138V'],
            ['zz2J'],
            ['l716V'],
            [['a']],
            [false],
            [new \stdClass()],
        ];
    }
}
