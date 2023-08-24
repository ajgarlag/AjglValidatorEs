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

use Ajgl\ValidatorEs\CccValidator as ValidatorEsCccValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class CccValidator extends ConstraintValidator
{
    private ValidatorEsCccValidator $cccValidator;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Ccc) {
            throw new UnexpectedTypeException($constraint, Ccc::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if ($this->getValidator()->isValid($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setCode(Ccc::IS_INVALID_ERROR)
            ->addViolation()
        ;
    }

    private function getValidator(): ValidatorEsCccValidator
    {
        if (!isset($this->cccValidator)) {
            $this->cccValidator = new ValidatorEsCccValidator();
        }

        return $this->cccValidator;
    }
}
