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
 * Validates that a CCC has valid format and checksum
 *
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class CccValidator extends ChecksumValidator
{
    const PATTERN = '/^[0-9]{20}$/';

    protected function computeChecksum($value)
    {
        return $this->computePartialChecksum('00'.substr($value,0,8)) . $this->computePartialChecksum(substr($value,10));
    }

    protected function computePartialChecksum($value)
    {
        $sum  = $value[0];
        $sum += $value[1]*2;
        $sum += $value[2]*4;
        $sum += $value[3]*8;
        $sum += $value[4]*5;
        $sum += $value[5]*10;
        $sum += $value[6]*9;
        $sum += $value[7]*7;
        $sum += $value[8]*3;
        $sum += $value[9]*6;

        return $sum%11>1?(11 - $sum%11):$sum%11;
    }

    protected function getChecksum($value)
    {
        return substr($value, 8, 2);
    }

    protected function getPattern()
    {
        return static::PATTERN;
    }

}
