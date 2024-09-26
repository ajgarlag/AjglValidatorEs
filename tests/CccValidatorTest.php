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

use Ajgl\ValidatorEs\CccValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @covers CccValidator
 */
#[CoversClass(CccValidator::class)]
final class CccValidatorTest extends TestCase
{
    private CccValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new CccValidator();
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
            [null],
            [new \stdClass()],
        ];
    }
}
