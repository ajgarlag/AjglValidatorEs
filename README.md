# AjglValidatorEs

This library provides some validators for common Spanish codes.

[![Build Status](https://github.com/ajgarlag/AjglValidatorEs/workflows/ci/badge.svg?branch=main)](https://github.com/ajgarlag/AjglValidatorEs/actions)
[![Latest Stable Version](https://poser.pugx.org/ajgl/validator-es/v)](https://packagist.org/packages/ajgl/validator-es) [![Total Downloads](https://poser.pugx.org/ajgl/validator-es/downloads)](https://packagist.org/packages/ajgl/validator-es) [![Latest Unstable Version](https://poser.pugx.org/ajgl/validator-es/v/unstable)](https://packagist.org/packages/ajgl/validator-es) [![License](https://poser.pugx.org/ajgl/validator-es/license)](https://packagist.org/packages/ajgl/validator-es) [![PHP Version Require](https://poser.pugx.org/ajgl/validator-es/require/php)](https://packagist.org/packages/ajgl/validator-es)

Current supported codes to validate are:
 * [DNI](http://es.wikipedia.org/wiki/Documento_de_identidad#Espa.C3.B1a)
 * [NIE](http://es.wikipedia.org/wiki/NIE)
 * IdCard (DNI or NIE)
 * [CCC](https://es.wikipedia.org/wiki/C%C3%B3digo_cuenta_cliente)
 * [IBAN](https://es.wikipedia.org/wiki/International_Bank_Account_Number#En_Espa%C3%B1a) (Limited to Spanish accounts)


## Installation

```sh
composer require ajgl/validator-es
```

## Usage

All validators implements a common interface with only one method:

```php
<?php
namespace Ajgl\ValidatorEs;

interface ValidatorInterface
{
    public function isValid(mixed $value): bool;
}
```

To use any validator, you must instantiate it, and call the `isValid` method:

```php
<?php
require 'vendor/autoload.php';

$value = 'Y0000000Z';
$validator = new \Ajgl\ValidatorEs\IdCardValidator();
assert($validator->isValid($value));
```

## License

This library is released under an open source license. See the complete license in the [LICENSE](LICENSE) file.


## Reporting an issue or a feature request

Read the [CONTRIBUTING.md](CONTRIBUTING.md) file.


## Author Information

Developed with ♥ by [Antonio J. García Lagar](https://aj.garcialagar.es).

If you find this library useful, please add a ★ in the [GitHub repository page](https://github.com/ajgarlag/AjglValidatorEs).
