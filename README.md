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


Badges
------

* **Travis CI**: [![Build Status](https://travis-ci.org/ajgarlag/AjglValidatorEs.png?branch=master)](https://travis-ci.org/ajgarlag/AjglValidatorEs)
* **Poser Latest Stable Version:** [![Latest Stable Version](https://poser.pugx.org/ajgl/validator-es/v/stable.png)](https://packagist.org/packages/ajgl/validator-es)
* **Poser Latest Unstable Version** [![Latest Unstable Version](https://poser.pugx.org/ajgl/validator-es/v/unstable.png)](https://packagist.org/packages/ajgl/validator-es)
* **Poser Total Downloads** [![Total Downloads](https://poser.pugx.org/ajgl/validator-es/downloads.png)](https://packagist.org/packages/ajgl/validator-es)
* **Poser Monthly Downloads** [![Montly Downloads](https://poser.pugx.org/ajgl/validator-es/d/monthly.png)](https://packagist.org/packages/ajgl/validator-es)
* **Poser Daily Downloads** [![Daily Downloads](https://poser.pugx.org/ajgl/validator-es/d/daily.png)](https://packagist.org/packages/ajgl/validator-es)
* **Scrutinizer Quality** [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/ajgarlag/AjglValidatorEs/badges/quality-score.png?s=d84dd9377e68fc2e1d2f85751c46bd92691a3464)](https://scrutinizer-ci.com/g/ajgarlag/AjglValidatorEs/)
* **Scrutinizer Code Coverage** [![Code Coverage](https://scrutinizer-ci.com/g/ajgarlag/AjglValidatorEs/badges/coverage.png?s=0143e64379404f3b3770acb5d5080d841ec75911)](https://scrutinizer-ci.com/g/ajgarlag/AjglValidatorEs/)
* **Bitdeli Popularity** [![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/ajgarlag/ajglvalidatores/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
* **SensionLabs Insight Quality** [![SensioLabsInsight](https://insight.sensiolabs.com/projects/ce97c09a-c83d-4ab7-83f9-90f33bf2ffd6/mini.png)](https://insight.sensiolabs.com/projects/ce97c09a-c83d-4ab7-83f9-90f33bf2ffd6)
* **VersionEye Dependency Status** [![Dependency Status](https://www.versioneye.com/php/ajgl:validator-es/dev-master/badge.png)](https://www.versioneye.com/php/ajgl:validator-es/dev-master)


About
-----

This is an [ajgarlag](http://aj.garcialagar.es) initiative.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/ajgarlag/AjglValidatorEs/issues).
