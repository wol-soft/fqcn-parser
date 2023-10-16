[![Latest Version](https://img.shields.io/packagist/v/wol-soft/fqcn-parser.svg)](https://packagist.org/packages/wol-soft/fqcn-parser)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)
[![Build Status](https://github.com/wol-soft/fqcn-parser/actions/workflows/main.yml/badge.svg)](https://github.com/wol-soft/fqcn-parser/actions/workflows/main.yml)
[![MIT License](https://img.shields.io/packagist/l/wol-soft/fqcn-parser.svg)](https://github.com/wol-soft/fqcn-parser/blob/master/LICENSE)

# fqcn-parser

Parse the FQCN from a PHP file containing a class, an interface, a trait or an enum (requires PHP >= 8.1).

## Requirements ##

- Requires at least PHP 8.0

## Installation ##

The recommended way to install fqcn-parser is through [Composer](http://getcomposer.org):
```
$ composer require wol-soft/fqcn-parser
```

## Usage ##

```php
$fqcn = FQCNParser::getFQCNFromFile(__DIR__ . '/MyClass.php');
```
