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

namespace Ajgl\ValidatorEs\Tests\Symfony\Bundle\DependencyInjection;

use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\DniValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\IdCardValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\NieValidator;
use Ajgl\ValidatorEs\Symfony\Bundle\DependencyInjection\AjglValidatorEsExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

/**
 * @covers AjglValidatorEsExtension
 */
#[CoversClass(AjglValidatorEsExtension::class)]
final class AjglValidatorEsExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new AjglValidatorEsExtension()];
    }

    /**
     * @dataProvider symfonyValidators
     */
    #[DataProvider('symfonyValidators')]
    public function testSymfonyValidatorsAreDefined(string $validatorClass): void
    {
        $this->load();
        $this->assertContainerBuilderHasService($validatorClass);
    }

    /**
     * @return list<array<int, string>>
     */
    public static function symfonyValidators(): array
    {
        return [
            [DniValidator::class],
            [IdCardValidator::class],
            [NieValidator::class],
        ];
    }
}
