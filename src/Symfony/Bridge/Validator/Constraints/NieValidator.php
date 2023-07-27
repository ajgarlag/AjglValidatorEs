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

namespace Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints;

use Ajgl\ValidatorEs\NieValidator as ValidatorEsNieValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class NieValidator extends ConstraintValidator
{
    private ValidatorEsNieValidator $nieValidator;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Nie) {
            throw new UnexpectedTypeException($constraint, Nie::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (is_string($value) && !$constraint->caseSensitive) {
            $value = mb_strtoupper($value);
        }

        if ($this->getValidator()->isValid($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setCode(Nie::IS_INVALID_ERROR)
            ->addViolation()
        ;
    }

    private function getValidator(): ValidatorEsNieValidator
    {
        if (!isset($this->nieValidator)) {
            $this->nieValidator = new ValidatorEsNieValidator();
        }

        return $this->nieValidator;
    }
}
