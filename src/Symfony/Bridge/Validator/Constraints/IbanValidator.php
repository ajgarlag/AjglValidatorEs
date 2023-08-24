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

use Ajgl\ValidatorEs\IbanValidator as ValidatorEsIbanValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class IbanValidator extends ConstraintValidator
{
    private ValidatorEsIbanValidator $ibanValidator;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Iban) {
            throw new UnexpectedTypeException($constraint, Iban::class);
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
            ->setCode(Iban::IS_INVALID_ERROR)
            ->addViolation()
        ;
    }

    private function getValidator(): ValidatorEsIbanValidator
    {
        if (!isset($this->ibanValidator)) {
            $this->ibanValidator = new ValidatorEsIbanValidator();
        }

        return $this->ibanValidator;
    }
}
