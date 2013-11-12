<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Validator\Es\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Ajgl\Validator\Es\ChecksumValidator as Validator;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class ChecksumValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        try {
            $this->getValidator()->validate($value);
        } catch (\InvalidArgumentException $e) {
            switch ($e->getCode()) {
                case Validator::CODE_INVALID_FORMAT:
                    $message = Validator::MSG_INVALID_FORMAT;
                    break;
                case Validator::CODE_INVALID_CHECKSUM:
                    $message = Validator::MSG_INVALID_CHECKSUM;
                    break;
                default:
                    throw $e;
            }

            $this->context->addViolation($message);
        }
    }

    /**
     * @return ChecksumValidator
     */
    abstract protected function getValidator();
}
