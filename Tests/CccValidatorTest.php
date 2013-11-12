<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Validator\Es\Tests;

use Ajgl\Validator\Es\CccValidator;

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
class CccValidatorTest extends ChecksumValidatorTest
{

    public $validFormatValue = '01234567890123456789';

    public $validValues = array(
        array('12345678010123456789'),
        array('00000000000000000000'),
        array('00010001650000000001'),
        array('99999999509999999999'),
        array('87654321510123456789'),
        array('11112222003333333333')
    );

    protected function setUp()
    {
        $this->object = new CccValidator();
    }

}
