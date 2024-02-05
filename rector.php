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

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Symfony\Set\SymfonySetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])

    ->withPreparedSets(deadCode: true, codeQuality: true, privatization: true, earlyReturn: true, instanceOf: true, typeDeclarations: true, strictBooleans: true)

    ->withSets([
        SetList::PHP_81,
        PHPUnitSetList::PHPUNIT_91,
        SymfonySetList::SYMFONY_54,
    ])
;
