<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Validator\Es;

/**
 * Validator interface
 *
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface ValidatorInterface
{
    /**
     * Validates the given value
     *
     * Will return void if the given value is valid or will throw an
     *  \InvalidArgumentException otherwise
     *
     * @param mixed
     * @throws \InvalidArgumentException
     */
    public function validate($value);
}
