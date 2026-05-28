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

use Ajgl\ValidatorEs\IdCardValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(IdCardValidator::class)]
final class IdCardValidatorTest extends TestCase
{
    private IdCardValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new IdCardValidator();
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
        yield ['Y7313897A'];
        yield ['Z6141300Y'];
        yield ['X7972230Q'];
        yield ['Z3607453T'];
        yield ['X8248943Q'];
        yield ['Z7950724C'];
        yield ['Z2249875C'];
        yield ['Z8532138V'];
        yield ['Y5742304T'];
        yield ['Y0739675D'];
    }

    public static function invalidValues(): \Iterator
    {
        yield ['Y3313897A'];
        yield ['Z7141300Y'];
        yield ['a8412892J'];
        yield ['zz2J'];
        yield ['l716V'];
        yield [['a']];
        yield [false];
        yield [null];
        yield [new \stdClass()];
    }
}
