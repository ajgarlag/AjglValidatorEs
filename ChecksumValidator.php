<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Validator\Es;

/**
 * Validates that a personal NIF has valid format and checksum
 *
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class ChecksumValidator implements ValidatorInterface
{
    const CODE_INVALID_FORMAT = 1;
    const CODE_INVALID_CHECKSUM = 2;

    const MSG_INVALID_FORMAT = "The given value has not in a valid format.";
    const MSG_INVALID_CHECKSUM = "Checksum failed for the given value.";

    public function validate($value)
    {
        if (!preg_match($this->getPattern(), $value)) {
            throw new \InvalidArgumentException(static::MSG_INVALID_FORMAT, static::CODE_INVALID_FORMAT);
        }

        if ($this->computeChecksum($value) != $this->getChecksum($value)) {
            throw new \InvalidArgumentException(static::MSG_INVALID_CHECKSUM, static::CODE_INVALID_CHECKSUM);
        }
    }

    /**
     * @return scalar
     */
    abstract protected function computeChecksum($value);

    /**
     * @return scalar
     */
    abstract protected function getChecksum($value);

    /**
     * @return string
     */
    abstract protected function getPattern();
}
