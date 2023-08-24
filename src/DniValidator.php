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

final class DniValidator implements ValidatorInterface
{
    use PatternValidatorTrait;
    use ChecksumValidatorTrait;
    private const PATTERN = '/^\d{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/';
    private const CHECKSUM = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];

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
        return substr($value, -1);
    }

    protected function computeChecksum(string $value): string
    {
        return self::CHECKSUM[substr($value, 0, -1) % 23];
    }
}
