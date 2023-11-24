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

final class DniChecksumCalculator implements ChecksumCalculatorInterface
{
    use PatternValidatorTrait;
    private const PATTERN = '/^\d{8}$/';
    private const CHECKSUM = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];

    public function isValid(string $value): bool
    {
        return $this->isValidPattern($value);
    }

    protected function getPattern(): string
    {
        return self::PATTERN;
    }

    public function calculateChecksum(string $value): string
    {
        if (!$this->isValid($value)) {
            throw new \InvalidArgumentException();
        }
        return self::CHECKSUM[$value % 23];
    }
}
