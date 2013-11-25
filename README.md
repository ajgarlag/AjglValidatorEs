AjglValidatorEs
===============

This library provides some validators for common Spanish codes.

Available validators
--------------------

* [DNI](http://es.wikipedia.org/wiki/Documento_de_identidad#Espa.C3.B1a "Documento Nacional de Identidad")
* [NIE](http://es.wikipedia.org/wiki/NIE "Número de Identidad de Extranjero")
* [CIF](http://es.wikipedia.org/wiki/C%C3%B3digo_de_identificaci%C3%B3n_fiscal "Código de Identificación Fiscal")
* [CCC](http://es.wikipedia.org/wiki/C%C3%B3digo_cuenta_cliente "Código Cuenta Cliente")

Usage
-----

All validators implements a common interface with only one method:
```php
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
```


Integration with Symfony Validator
----------------------------------

For each validator, a suitable Constraint and ConstraintValidator class is provided,
so you can use the Symfony Validator service.

```php
$validator = \Symfony\Component\Validation::createValidator();
$violations = $validator->validateValue('00000001Z', new \Ajgl\Validator\Es\Constraints\Dni());
```

Symfony Bundle
--------------

If you need to integrate these validators into your Symfony Framework app, you
can install the [AjglValidatorEsBundle](https://github.com/ajgarlag/AjglValidatorEsBundle)

License
---------

This library is under the MIT license. See the complete license in the LICENSE file.


About
-----

This is an [ajgarlag](http://aj.garcialagar.es) initiative.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/ajgarlag/AjglValidatorEs/issues).
