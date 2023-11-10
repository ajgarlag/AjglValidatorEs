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

final class NieValidator implements ValidatorInterface
{
    use PatternValidatorTrait;
    use ChecksumValidatorTrait;
    private const PATTERN = '/^[XYZ]\d{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/';
    private NieChecksumCalculator $nieChecksumCalculator;

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
        return $this->nieChecksumCalculator()->calculateChecksum(substr($value, 0, -1));
    }

    private function nieChecksumCalculator(): NieChecksumCalculator
    {
        if (!isset($this->nieChecksumCalculator)) {
            $this->nieChecksumCalculator = new NieChecksumCalculator();
        }

        return $this->nieChecksumCalculator;
    }
}
