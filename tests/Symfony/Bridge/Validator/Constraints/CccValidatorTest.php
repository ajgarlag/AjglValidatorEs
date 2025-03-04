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

use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\Ccc;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\CccValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @extends ConstraintValidatorTestCase<CccValidator>
 */
#[CoversClass(CccValidator::class)]
final class CccValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): CccValidator
    {
        return new CccValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->validator->validate($value, new Ccc());

        $this->assertNoViolation();
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->validator->validate($value, new Ccc());

        $this->buildViolation((new Ccc())->message)->setCode(Ccc::IS_INVALID_ERROR)->assertRaised();
    }

    /**
     * @return \Iterator<list<string>>
     */
    public static function validValues(): \Iterator
    {
        yield from [
            ['12345678010123456789'],
            ['00000000000000000000'],
            ['00010001650000000001'],
            ['99999999509999999999'],
            ['87654321510123456789'],
            ['11112222003333333333'],
        ];
    }

    /**
     * @return \Iterator<list<mixed>>
     */
    public static function invalidValues(): \Iterator
    {
        yield from [
            ['12345678010123aaaaaa'],
            ['00000000000O00000000'],
            ['00010001650000000005'],
            ['9999999950999999999'],
            [['a']],
            [false],
            [new \stdClass()],
        ];
    }
}
