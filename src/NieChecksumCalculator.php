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

final class NieChecksumCalculator implements ChecksumCalculatorInterface
{
    use PatternValidatorTrait;
    private const PATTERN = '/^[XYZ]\d{7}$/i';
    private DniChecksumCalculator $dniChecksumCalculator;

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
        return $this->dniChecksumCalculator()->calculateChecksum(strtr(strtoupper($value), 'XYZ', '012'));
    }

    private function dniChecksumCalculator(): DniChecksumCalculator
    {
        if (!isset($this->dniChecksumCalculator)) {
            $this->dniChecksumCalculator = new DniChecksumCalculator();
        }

        return $this->dniChecksumCalculator;
    }
}
