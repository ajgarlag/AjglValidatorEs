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

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
            ->autoconfigure()
    ;

    $services->load(
        'Ajgl\\ValidatorEs\\Symfony\\Bridge\\Validator\\Constraints\\',
        __DIR__ . '/../../../Bridge/Validator/Constraints/*Validator.php'
    );

    $services->load(
        'Ajgl\\ValidatorEs\\',
        __DIR__ . '/../../../../*{Calculator,Validator}.php'
    );
};
