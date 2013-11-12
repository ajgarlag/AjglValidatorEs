<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Validator\Es\Tests\Constraints;

use Ajgl\Validator\Es\Constraints\Nie;
use Ajgl\Validator\Es\Constraints\NieValidator;
use Ajgl\Validator\Es\Tests\NieValidatorTest as ValidatorTest;

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
class NieValidatorTest extends ChecksumValidatorTest
{
    protected function createConstraint()
    {
        return new Nie();
    }

    protected function createValidator()
    {
        return new NieValidator();
    }

    public function getValidFormatValue()
    {
        $test = new ValidatorTest();

        return $test->validFormatValue;
    }

    public function getValidValues()
    {
        $test = new ValidatorTest();

        return $test->validValues;
    }

}
