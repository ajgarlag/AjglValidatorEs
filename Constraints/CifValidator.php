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

use Ajgl\Validator\Es\CifValidator as Validator;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class CifValidator extends ChecksumValidator
{
    /**
     * @var Validator
     */
    private $validator;

    protected function getValidator()
    {
        if (null === $this->validator) {
            $this->validator = new Validator();
        }

        return $this->validator;
    }
}
