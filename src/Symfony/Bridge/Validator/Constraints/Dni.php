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

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class Dni extends Constraint
{
    public const IS_INVALID_ERROR = '97267c12-cbc2-4a93-8b06-9206785c2d63';

    protected const ERROR_NAMES = [
        self::IS_INVALID_ERROR => 'IS_INVALID_ERROR',
    ];

    public bool $caseSensitive = false;
    public string $message = 'The value is not a valid DNI.';

    /**
     * @param list<string>|null $groups
     * @param array<array-key, mixed> $options
     */
    public function __construct(
        bool $caseSensitive = null,
        string $message = null,
        array $groups = null,
        mixed $payload = null,
        array $options = []
    ) {
        parent::__construct($options, $groups, $payload);

        $this->caseSensitive = $caseSensitive ?? $this->caseSensitive;
        $this->message = $message ?? $this->message;
    }
}
