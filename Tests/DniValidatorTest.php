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

use Ajgl\Validator\Es\DniValidator;

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
class DniValidatorTest extends ChecksumValidatorTest
{

    public $validFormatValue = '12345678A';

    public $validValues = array(
        array('44055333Y'),
        array('84085859K'),
        array('21873322T'),
        array('68412892J'),
        array('73779716V'),
        array('88819264A'),
        array('50623719Y'),
        array('02288983T'),
        array('64932327S'),
        array('81532270F')
    );

    protected function setUp()
    {
        $this->object = new DniValidator();
    }

}
