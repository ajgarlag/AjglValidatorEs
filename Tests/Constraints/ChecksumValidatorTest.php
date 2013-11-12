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

use Ajgl\Validator\Es\ChecksumValidator;

/**
 * @autor Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class ChecksumValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Symfony\Component\Validator\ExecutionContextInterface
     */
    protected $context;

    /**
     * @var \Ajgl\Validator\Es\ChecksumValidator
     */
    protected $object;

    protected function setUp()
    {
        $this->object = $this->createValidator();
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContextInterface');
        $this->object->initialize($this->context);
    }

    /**
     * @return \Ajgl\Validator\Es\ChecksumValidator
     */
    abstract protected function createValidator();

    /**
     * @return \Symfony\Component\Validator\Constraint
     */
    abstract protected function createConstraint();

    /**
     * @return \Symfony\Component\Validator\Constraint
     */
    abstract public function getValidFormatValue();

    /**
     * @return \Symfony\Component\Validator\Constraint
     */
    abstract public function getValidValues();

    public function testValidateFailsOnInvalidFormat()
    {
        $this->context
            ->expects($this->once())
            ->method('addViolation')
            ->with(ChecksumValidator::MSG_INVALID_FORMAT);

        $this->object->validate('foo', $this->createConstraint());
    }

    public function testValidateFailsOnInvalidChecksum()
    {
        $value = '12345678A';
        $this->context
            ->expects($this->once())
            ->method('addViolation')
            ->with(ChecksumValidator::MSG_INVALID_CHECKSUM);

        $this->object->validate($this->getValidFormatValue(), $this->createConstraint());
    }

    /**
     * @dataProvider getValidValues
     */
    public function testValidateWithValidValues($value)
    {
        $this->context
            ->expects($this->never())
            ->method('addViolation');

        $this->object->validate($value, $this->createConstraint());
    }

}
