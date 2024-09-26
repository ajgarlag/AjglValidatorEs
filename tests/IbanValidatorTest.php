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

use Ajgl\ValidatorEs\IbanValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @covers IbanValidator
 */
#[CoversClass(IbanValidator::class)]
final class IbanValidatorTest extends TestCase
{
    private IbanValidator $validator;

    protected function setUp(): void
    {
        if (!extension_loaded('gmp')) {
            $this->markTestSkipped(
                'The GMP extension is not available.'
            );
        }
        $this->validator = new IbanValidator();
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
            ['ES5812345678010123456789'],
            ['ES8200000000000000000000'],
            ['ES8200010001650000000001'],
            ['ES1299999999509999999999'],
            ['ES7287654321510123456789'],
            ['ES3011112222003333333333'],
        ];
    }

    /**
     * @return \Iterator<list<mixed>>
     */
    public static function invalidValues(): \Iterator
    {
        yield from [
            ['ES0812345678010123456789'],
            ['FR0000000000000000000000'],
            ['E58200010001650000000001'],
            ['ES12999999995099999999'],
            [['a']],
            [false],
            [null],
            [new \stdClass()],
        ];
    }
}
