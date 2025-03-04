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

use Ajgl\ValidatorEs\CccValidator;
use Ajgl\ValidatorEs\DniChecksumCalculator;
use Ajgl\ValidatorEs\DniValidator;
use Ajgl\ValidatorEs\IbanChecksumCalculator;
use Ajgl\ValidatorEs\IbanValidator;
use Ajgl\ValidatorEs\IdCardChecksumCalculator;
use Ajgl\ValidatorEs\IdCardValidator;
use Ajgl\ValidatorEs\NieChecksumCalculator;
use Ajgl\ValidatorEs\NieValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\CccValidator as ConstraintsCccValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\DniValidator as ConstraintsDniValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\IbanValidator as ConstraintsIbanValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\IdCardValidator as ConstraintsIdCardValidator;
use Ajgl\ValidatorEs\Symfony\Bridge\Validator\Constraints\NieValidator as ConstraintsNieValidator;
use Ajgl\ValidatorEs\Symfony\Bundle\DependencyInjection\AjglValidatorEsExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

#[CoversClass(AjglValidatorEsExtension::class)]
final class AjglValidatorEsExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new AjglValidatorEsExtension()];
    }

    #[DataProvider('symfonyValidators')]
    public function testSymfonyValidatorsAreDefined(string $validatorClass): void
    {
        $this->load();
        $this->assertContainerBuilderHasService($validatorClass);
    }

    /**
     * @return \Iterator<array<int, string>>
     */
    public static function symfonyValidators(): \Iterator
    {
        yield [ConstraintsDniValidator::class];
        yield [ConstraintsIdCardValidator::class];
        yield [ConstraintsNieValidator::class];
        yield [ConstraintsCccValidator::class];
        yield [ConstraintsIbanValidator::class];
    }

    #[DataProvider('validators')]
    public function testValidatorsAreDefined(string $validatorClass): void
    {
        $this->load();
        $this->assertContainerBuilderHasService($validatorClass);
    }

    /**
     * @return \Iterator<array<int, string>>
     */
    public static function validators(): \Iterator
    {
        yield [DniValidator::class];
        yield [IdCardValidator::class];
        yield [NieValidator::class];
        yield [CccValidator::class];
        yield [IbanValidator::class];
    }

    #[DataProvider('calculators')]
    public function testCalculatorsAreDefined(string $calculatorClass): void
    {
        $this->load();
        $this->assertContainerBuilderHasService($calculatorClass);
    }

    /**
     * @return \Iterator<array<int, string>>
     */
    public static function calculators(): \Iterator
    {
        yield [DniChecksumCalculator::class];
        yield [IdCardChecksumCalculator::class];
        yield [NieChecksumCalculator::class];
        yield [IbanChecksumCalculator::class];
    }
}
