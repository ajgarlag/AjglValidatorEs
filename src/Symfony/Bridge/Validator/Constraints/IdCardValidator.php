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

use Ajgl\ValidatorEs\IdCardValidator as ValidatorEsIdCardValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class IdCardValidator extends ConstraintValidator
{
    private ValidatorEsIdCardValidator $idCardValidator;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof IdCard) {
            throw new UnexpectedTypeException($constraint, IdCard::class);
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
            ->setCode(IdCard::IS_INVALID_ERROR)
            ->addViolation()
        ;
    }

    private function getValidator(): ValidatorEsIdCardValidator
    {
        if (!isset($this->idCardValidator)) {
            $this->idCardValidator = new ValidatorEsIdCardValidator();
        }

        return $this->idCardValidator;
    }
}
