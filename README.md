# Install packages from composer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/noogic/composer-installer.svg?style=flat-square)](https://packagist.org/packages/noogic/composer-installer)
[![Build Status](https://img.shields.io/travis/noogic/composer-installer/master.svg?style=flat-square)](https://travis-ci.org/noogic/composer-installer)
[![Quality Score](https://img.shields.io/scrutinizer/g/noogic/composer-installer.svg?style=flat-square)](https://scrutinizer-ci.com/g/noogic/composer-installer)
[![Total Downloads](https://img.shields.io/packagist/dt/noogic/composer-installer.svg?style=flat-square)](https://packagist.org/packages/noogic/composer-installer)

This packages is meant for php projects setup. It will use composer to require packages inside of an actual project.

This is useful for example when trying to create a base project. Instead of forking it every time or downloading the zip manually, it's recommended to have a really stable
base, for example the last version of Laravel, and then have packages to setup this base project. Since packages can be installed and updated using composer, it's easier to 
keep all the projects up to date.   

## Installation

You can install the package via composer:

```bash
composer require noogic/composer-installer
```

## Usage

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email joanmorellandres@gmail.com instead of using the issue tracker.

## Credits

- [Joan Morell](https://github.com/noogic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
