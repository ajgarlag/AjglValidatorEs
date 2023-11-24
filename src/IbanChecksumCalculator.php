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

use RuntimeException;

final class IbanChecksumCalculator implements ChecksumCalculatorInterface
{
    use PatternValidatorTrait;

    private const PATTERN = '/^\d{20}$/';
    private const ES_CODE = '142800';

    public function isValid(string $value): bool
    {
        return $this->isValidPattern($value) && (new CccValidator())->isValid($value);
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

        if (!\function_exists('gmp_intval')) {
            throw new RuntimeException('The "gmp" PHP extension is not loaded.');
        }

        $mod = 98 - gmp_intval(gmp_mod(gmp_init($value . self::ES_CODE, 10), 97));

        return str_pad((string) $mod, 2, '0', \STR_PAD_LEFT);
    }
}
