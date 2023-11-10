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

final class IdCardChecksumCalculator implements ChecksumCalculatorInterface
{
    private DniChecksumCalculator $dniChecksumCalculator;
    private NieChecksumCalculator $nieChecksumCalculator;

    private function dniChecksumCalculator(): DniChecksumCalculator
    {
        if (!isset($this->dniChecksumCalculator)) {
            $this->dniChecksumCalculator = new DniChecksumCalculator();
        }

        return $this->dniChecksumCalculator;
    }

    private function nieChecksumCalculator(): NieChecksumCalculator
    {
        if (!isset($this->nieChecksumCalculator)) {
            $this->nieChecksumCalculator = new NieChecksumCalculator();
        }

        return $this->nieChecksumCalculator;
    }

    public function isValid(string $value): bool
    {
        if ($this->dniChecksumCalculator()->isValid($value)) {
            return true;
        }
        return $this->nieChecksumCalculator()->isValid($value);
    }

    public function calculateChecksum(string $value): string
    {
        if ($this->dniChecksumCalculator()->isValid($value)) {
            return $this->dniChecksumCalculator()->calculateChecksum($value);
        }
        if ($this->nieChecksumCalculator()->isValid($value)) {
            return $this->nieChecksumCalculator()->calculateChecksum($value);
        }

        throw new \InvalidArgumentException();
    }
}
