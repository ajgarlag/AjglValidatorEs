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

final class IdCardValidator implements ValidatorInterface
{
    private DniValidator $dniValidator;
    private NieValidator $nieValidator;

    private function initialize(): void
    {
        if (!isset($this->dniValidator)) {
            $this->dniValidator = new DniValidator();
        }

        if (!isset($this->nieValidator)) {
            $this->nieValidator = new NieValidator();
        }
    }

    public function isValid(mixed $value): bool
    {
        $this->initialize();

        if ($this->dniValidator->isValid($value)) {
            return true;
        }

        return $this->nieValidator->isValid($value);
    }
}
