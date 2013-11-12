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
 * Validates that a DNI has valid format and checksum
 *
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class DniValidator extends ChecksumValidator
{
    const PATTERN = '/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/';
    const CHECKSUM = 'TRWAGMYFPDXBNJZSQVHLCKE';

    protected function computeChecksum($value)
    {
        $checksum = static::CHECKSUM;

        return $checksum[substr($value, 0, -1) % 23];
    }

    protected function getChecksum($value)
    {
        return substr($value, -1);
    }

    protected function getPattern()
    {
        return static::PATTERN;
    }

}
