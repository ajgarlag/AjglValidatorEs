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

use Symfony\Component\Validator\Constraint;
use Ajgl\Validator\Es\NieValidator as Validator;

/**
 * @Annotation
 *
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class Nie extends Constraint
{
    public $invalidFormatMessage = Validator::MSG_INVALID_FORMAT;
    public $invalidChecksumMessage = Validator::MSG_INVALID_CHECKSUM;
}
