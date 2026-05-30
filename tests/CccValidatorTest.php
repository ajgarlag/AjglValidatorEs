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

#[CoversClass(CccValidator::class)]
final class CccValidatorTest extends TestCase
{
    private CccValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new CccValidator();
    }

    #[DataProvider('validValues')]
    public function testValidValues(string $value): void
    {
        $this->assertTrue($this->validator->isValid($value));
    }

    #[DataProvider('invalidValues')]
    public function testInvalidValues(mixed $value): void
    {
        $this->assertFalse($this->validator->isValid($value));
    }

    public static function validValues(): \Iterator
    {
        yield ['12345678010123456789'];
        yield ['00000000000000000000'];
        yield ['00010001650000000001'];
        yield ['99999999509999999999'];
        yield ['87654321510123456789'];
        yield ['11112222003333333333'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['12345678010123aaaaaa'];
        yield ['00000000000O00000000'];
        yield ['00010001650000000005'];
        yield ['9999999950999999999'];
        yield [['a']];
        yield [false];
        yield [null];
        yield [new \stdClass()];
    }
}
