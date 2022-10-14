## Laravel Permissions UI

This package will create a simple Dashboard for managing roles/permissions based on the spatie/laravel-permission package.

**Notice**: this is a very early version of the package, may be buggy. Not for production.

- - - - -

## Installation

```sh
composer require laraveldaily/laravel-permissions-ui
```

Go to `yourdomain.com/permissions` and you should see a simple dashboard with three menu items on top.

That dashboard is by default protected by `auth` middleware, but you can configure it:

```sh
php artisan vendor:publish --provider="LaravelDaily\PermissionsUI\PermissionsUIServiceProvider"
```

And then edit the values in `config/permissions.php`

- - - - -

## Testing

To run the package's unit tests, run the following command:

```sh
vendor/bin/phpunit
```
