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

use Ajgl\ValidatorEs\NieValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Safe\Exceptions\PcreException;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * @covers NieValidator
 */
#[CoversClass(NieValidator::class)]
final class NieValidatorTest extends TestCase
{
    private NieValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new NieValidator();
    }

    /**
     * @dataProvider validValues
     */
    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        self::assertTrue($this->validator->isValid($value));
    }

    /**
     * @dataProvider invalidValues
     */
    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        self::assertFalse($this->validator->isValid($value));
    }

    /**
     * @return list<list<string>>
     */
    public static function validValues(): iterable
    {
        yield from [
            ['Y7313897A'],
            ['Z6141300Y'],
            ['X7972230Q'],
            ['Z3607453T'],
            ['X8248943Q'],
            ['Z7950724C'],
            ['Z2249875C'],
            ['Z8532138V'],
            ['Y5742304T'],
            ['Y0739675D'],
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
            ['a1873322T'],
            ['Y3313897A'],
            ['Z7141300Y'],
            ['A8412892J'],
            ['zz2J'],
            ['l716V'],
            [['a']],
            [false],
            [null],
            [new \stdClass()],
        ];
    }
}
