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
 * Validates that a CIF has valid format and checksum
 *
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class CifValidator extends ChecksumValidator
{
    const PATTERN = '/^[ABCDEFGHJKLMNPRQSUVW][0-9]{7}[0-9ABCDEFGHIJ]$/';
    const CHECKSUM = 'JABCDEFGHI';

    public function validate($value)
    {
        parent::validate($value);

        if (strpos('KQS', $value[0]) !== false && is_numeric(substr($value, -1))) {
            throw new \InvalidArgumentException(static::MSG_INVALID_FORMAT, static::CODE_INVALID_FORMAT);
        } elseif (strpos('ABEH', $value[0]) !== false && !is_numeric(substr($value, -1))) {
            throw new \InvalidArgumentException(static::MSG_INVALID_FORMAT, static::CODE_INVALID_FORMAT);
        }
    }

    protected function computeChecksum($value)
    {
        $sum = 0;
        for ($i = 1; $i < 8; $i++) {
            if ($i%2 == 1) {
                $sum += (2*$value[$i]>9)?2*$value[$i]-9:2*$value[$i];
            } else {
                $sum += $value[$i];
            }
        }

        return ($sum%10==0)?0:(10 - ($sum%10));
    }

    protected function getChecksum($value)
    {
        $checksum = substr($value, -1);

        return (is_numeric($checksum))?$checksum:strpos(static::CHECKSUM, $checksum);
    }

    protected function getPattern()
    {
        return static::PATTERN;
    }

}
