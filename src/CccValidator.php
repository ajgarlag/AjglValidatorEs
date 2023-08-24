<?php

declare(strict_types=1);

/*
 * AJGL Validator ES
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\ValidatorEs;

final class CccValidator implements ValidatorInterface
{
    use PatternValidatorTrait;
    use ChecksumValidatorTrait;
    private const PATTERN = '/^\d{20}$/';

    public function isValid(mixed $value): bool
    {
        return
            is_string($value)
            && $this->isValidPattern($value)
            && $this->isValidChecksum($value)
        ;
    }

    protected function getPattern(): string
    {
        return self::PATTERN;
    }

    protected function extractChecksum(string $value): string
    {
        return substr($value, 8, 2);
    }

    protected function computeChecksum(string $value): string
    {
        return $this->computePartialChecksum('00'.substr($value, 0, 8)) . $this->computePartialChecksum(substr($value, 10));
    }

    private function computePartialChecksum(string $value): string
    {
        $sum  = (int) $value[0];
        $sum += (int) $value[1] * 2;
        $sum += (int) $value[2] * 4;
        $sum += (int) $value[3] * 8;
        $sum += (int) $value[4] * 5;
        $sum += (int) $value[5] * 10;
        $sum += (int) $value[6] * 9;
        $sum += (int) $value[7] * 7;
        $sum += (int) $value[8] * 3;
        $sum += (int) $value[9] * 6;

        $result = $sum % 11 > 1 ? (11 - $sum % 11) : $sum % 11;

        return (string) $result;
    }
}
