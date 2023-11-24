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

final class IbanValidator implements ValidatorInterface
{
    use PatternValidatorTrait;
    use ChecksumValidatorTrait;
    private const PATTERN = '/^ES\d{22}$/';
    private IbanChecksumCalculator $ibanChecksumCalculator;

    public function isValid(mixed $value): bool
    {
        return
            is_string($value)
            && $this->isValidPattern($value)
            && (new CccValidator())->isValid(substr($value, 4))
            && $this->isValidChecksum($value)
        ;
    }

    protected function getPattern(): string
    {
        return self::PATTERN;
    }

    protected function extractChecksum(string $value): string
    {
        return substr($value, 2, 2);
    }

    protected function computeChecksum(string $value): string
    {
        return $this->ibanChecksumCalculator()->calculateChecksum(substr($value, 4));
    }

    private function ibanChecksumCalculator(): IbanChecksumCalculator
    {
        if (!isset($this->ibanChecksumCalculator)) {
            $this->ibanChecksumCalculator = new IbanChecksumCalculator();
        }

        return $this->ibanChecksumCalculator;
    }
}
