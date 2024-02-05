<?php

use PhpCsFixer\Config;

$header = <<<'EOL'
    AJGL Validator ES

    Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.
    EOL;

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PER-CS' => true,
            '@PER-CS:risky' => true,
            '@PHP81Migration' => true,
            '@PHP80Migration:risky' => true,
            'header_comment' => ['header' => $header],
        ]
    )
    ->setFinder(
        \PhpCsFixer\Finder::create()
            ->in(__DIR__)
    )
;
