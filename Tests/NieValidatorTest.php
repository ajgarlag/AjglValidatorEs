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

use Ajgl\Validator\Es\NieValidator;

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
class NieValidatorTest extends ChecksumValidatorTest
{

    public $validFormatValue = 'X1234567A';

    public $validValues = array(
        array('Y7313897A'),
        array('Z6141300Y'),
        array('X7972230Q'),
        array('Z3607453T'),
        array('X8248943Q'),
        array('Z7950724C'),
        array('Z2249875C'),
        array('Z8532138V'),
        array('Y5742304T'),
        array('Y0739675D')
    );

    protected function setUp()
    {
        $this->object = new NieValidator();
    }

}
