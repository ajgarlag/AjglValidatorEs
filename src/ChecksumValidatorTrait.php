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

trait ChecksumValidatorTrait
{
    public function isValidChecksum(string $value): bool
    {
        return $this->extractChecksum($value) === $this->computeChecksum($value);
    }

    abstract protected function computeChecksum(string $value): string;

    abstract protected function extractChecksum(string $value): string;
}
