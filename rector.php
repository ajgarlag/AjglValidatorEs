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

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])

    ->withPhpSets()

    ->withPreparedSets(deadCode: true, codeQuality: true, privatization: true, earlyReturn: true, instanceOf: true, typeDeclarations: true, strictBooleans: true, phpunitCodeQuality: true, symfonyCodeQuality: true)
    ->withComposerBased(phpunit: true)
;
