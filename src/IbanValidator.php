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

final class IbanValidator implements ValidatorInterface
{
    use PatternValidatorTrait;
    use ChecksumValidatorTrait;
    private const PATTERN = '/^ES\d{22}$/';
    private const ES_CODE = '142800';

    public function isValid(mixed $value): bool
    {
        return
            is_string($value)
            && $this->isValidPattern($value)
            && $this->isValidChecksum($value)
            && (new CccValidator())->isValid(substr($value, 4))
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
        if (!\function_exists('gmp_intval')) {
            throw new RuntimeException('The "gmp" PHP extension is not loaded.');
        }

        $mod = 98 - gmp_intval(gmp_mod(gmp_init(substr($value, 4).self::ES_CODE, 10), 97));
        return str_pad((string) $mod, 2, '0', \STR_PAD_LEFT);
    }
}
