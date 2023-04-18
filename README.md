# Laravel Impersonate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pinetco-dev/laravel-impersonate.svg?style=flat-square)](https://packagist.org/packages/pinetco-dev/laravel-impersonate)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/pinetco-dev/laravel-impersonate/run-tests?label=tests)](https://github.com/pinetco-dev/laravel-impersonate/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/pinetco-dev/laravel-impersonate/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/pinetco-dev/laravel-impersonate/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/pinetco-dev/laravel-impersonate.svg?style=flat-square)](https://packagist.org/packages/pinetco-dev/laravel-impersonate)

Laravel Impersonate is a package that allows you to easily and securely impersonate other users within a Laravel
application. This can be particularly useful for debugging problems and generating scenarios after deploying your
application to production.

## Installation

You can install the package via composer:

```bash
composer require pinetco-dev/laravel-impersonate
```

Once you have installed the package, you can publish and run the migrations with the following command:

```bash
php artisan vendor:publish --tag="impersonate-migrations"
php artisan migrate
```

## Usage

The package comes with a configuration file that allows you to customize its settings according to your needs. You can
publish the configuration file using the following command:

```bash
php artisan vendor:publish --tag="impersonate-config"
```

After publishing the configuration file, you need to specify the URL where impersonate webhooks should hit your
application. To do this, add the following line to your routes file:
```bash
Route::impersonation();
```

### Middleware

If you want to protect specific pages against user impersonation, you can use the impersonate.protect middleware. For
example:
```php
Router::get('/payment', function() {
    echo "This page cannot be accessed by an impersonator.";
})->middleware('impersonate.protect');
```

### Blade
There are some blade directives available that allow you to customize the behavior of your application depending on whether the user can impersonate or is being impersonated.
#### When the user can impersonate
```php
@canImpersonate
    <a href="{{ route('impersonate', $user) }}">Login as {{ $user->name }}</a>
@endCanImpersonate
```
#### When the user is being impersonated
```php
@impersonating
    <a href="{{ route('impersonate.leave', ['impersonate' => get_impersonate_session_value()]) }}">
        Leave impersonation mode
    </a>
@endImpersonating
```

## Testing
You can run the tests using the following command:

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
