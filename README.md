# Laravel Impersonate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pinetco-dev/laravel-impersonate.svg?style=flat-square)](https://packagist.org/packages/pinetco-dev/laravel-impersonate)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/pinetco-dev/laravel-impersonate/run-tests?label=tests)](https://github.com/pinetco-dev/laravel-impersonate/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/pinetco-dev/laravel-impersonate/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/pinetco-dev/laravel-impersonate/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/pinetco-dev/laravel-impersonate.svg?style=flat-square)](https://packagist.org/packages/pinetco-dev/laravel-impersonate)

After deploying application to production, We may need to **"impersonate"** another user of application which debug problems and scenario generation. From this package, you can use impersonation functionality in your laravel application.

## Installation

You can install the package via composer:

```bash
composer require pinetco-dev/laravel-impersonate
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="impersonate-migrations"
php artisan migrate
```

## Usage

```php
$laravelImpersonate = new Pinetcodev\LaravelImpersonate();
echo $laravelImpersonate->echoPhrase('Hello, Pinetcodev!');
```

## Usage
The package comes with a configuration file.

Publish it with the following command:

```bash
php artisan vendor:publish --tag="laravel-impersonate-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Pooja Jadav](https://github.com/pinetco-dev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
