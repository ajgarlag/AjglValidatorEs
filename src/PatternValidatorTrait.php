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

use function Safe\preg_match;

trait PatternValidatorTrait
{
    public function isValidPattern(string $value): bool
    {
        return 1 === preg_match($this->getPattern(), $value);
    }

    abstract protected function getPattern(): string;
}
