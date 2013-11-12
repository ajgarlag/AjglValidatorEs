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

use Ajgl\Validator\Es\CifValidator;

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
class CifValidatorTest extends ChecksumValidatorTest
{

    public $validFormatValue = 'A12345678';

    public $validValues = array(
        array('D31055031'),
        array('S4045121C'),
        array('F83338459'),
        array('A67078832'),
        array('S0740107H'),
        array('N4513511H'),
        array('A55161202'),
        array('S2592092G'),
        array('S9281814E'),
        array('M07415680')
    );

    protected function setUp()
    {
        $this->object = new CifValidator();
    }

    /**
     * @dataProvider getValidValues
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 1
     * @expectedExceptionMessage \Ajgl\Validator\Es\ChecksumValidator::MSG_INVALID_FORMAT
     */
    public function testValidateFailsOnInvalidFormatByChecksumType($value)
    {
        $letters = CifValidator::CHECKSUM;

        if (strpos('KQS', $value[0]) !== false) {
            $value[8] = strpos($letters, $value[8]);
            $this->object->validate($value);
        } elseif (strpos('ABEH', $value[0]) !== false) {
            $value[8] = $letters[$value[8]];
            $this->object->validate($value);
        } else {
            $this->markTestSkipped();
        }
    }

}
