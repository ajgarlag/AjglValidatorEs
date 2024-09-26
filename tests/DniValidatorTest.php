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

use Ajgl\ValidatorEs\DniValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @covers DniValidator
 */
#[CoversClass(DniValidator::class)]
final class DniValidatorTest extends TestCase
{
    private DniValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new DniValidator();
    }

    /**
     * @dataProvider validValues
     */
    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->assertTrue($this->validator->isValid($value));
    }

    /**
     * @dataProvider invalidValues
     */
    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->assertFalse($this->validator->isValid($value));
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
            ['88819264A'],
            ['50623719Y'],
            ['02288983T'],
            ['64932327S'],
            ['81532270F'],
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
            [null],
            [new \stdClass()],
        ];
    }
}
