# fqcn-parser

Parse the FQCN from a PHP file containing a class.

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
