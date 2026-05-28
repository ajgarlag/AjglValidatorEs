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

#[CoversClass(DniValidator::class)]
final class DniValidatorTest extends TestCase
{
    private DniValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new DniValidator();
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
        yield ['44055333Y'];
        yield ['84085859K'];
        yield ['21873322T'];
        yield ['68412892J'];
        yield ['73779716V'];
        yield ['88819264A'];
        yield ['50623719Y'];
        yield ['02288983T'];
        yield ['64932327S'];
        yield ['81532270F'];
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
        yield [null];
        yield [new \stdClass()];
    }
}
