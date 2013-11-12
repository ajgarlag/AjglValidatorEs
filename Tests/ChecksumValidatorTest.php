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

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class ChecksumValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Ajgl\Validator\Es\ChecksumValidator
     */
    protected $object;

    public $validFormatValue;

    public $validValues = array();

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 1
     * @expectedExceptionMessage \Ajgl\Validator\Es\ChecksumValidator::MSG_INVALID_FORMAT
     */
    public function testValidateFailsOnInvalidFormat()
    {
        $this->object->validate('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 2
     * @expectedExceptionMessage \Ajgl\Validator\Es\ChecksumValidator::MSG_INVALID_CHECKSUM
     */
    public function testValidateFailsOnInvalidChecksum()
    {
        $this->object->validate($this->validFormatValue);
    }

    /**
     * @dataProvider getValidValues
     */
    public function testValidateWithValidValues($value)
    {
        $this->assertNull($this->object->validate($value));
    }

    public function getValidValues()
    {
        return $this->validValues;
    }

}
