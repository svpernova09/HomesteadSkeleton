# Homestead Skeleton

The purpose of this is to easily provide the [Laravel Homestead](https://github.com/laravel/homestead) Vagrant environment without having to rely on using the ```homestead``` command line application. Another use case would be if you do not have / do not want PHP locally installed on your system.

## Installation

Add ```"svpernova09/homesteadskeleton": "dev-feature/package"``` to your project's ```composer.json``` in require-dev.
Add to ```app/Providers/AppServiceProvider.php```:

```
if ($this->app->environment() == 'local') {
    $this->app->register('Svpernova09\HomesteadSkeleton\HomesteadSkeletonServiceProvider');
}
```

## Usage

```php artisan homestead:create```

Further Homestead configuration see [Official Documentation](http://laravel.com/docs/5.0/homestead)

## Caution

If you plan on using this in multiple projects or alongside Homestead's normal usage, ensure you change ```vb.name``` in ```src/scripts/homestead.rb``` to something unique.
