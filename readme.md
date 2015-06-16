# Homestead Skeleton

The purpose of this is package is to easily provide the [Laravel Homestead](https://github.com/laravel/homestead)
Vagrant environment without having to rely on using the ```homestead``` command line application.
Another use case would be if you do not have / do not want PHP locally installed on your system.

You will at least need composer on your system to use this artisan command.
If you do not have / want composer on your local system, copy everything in the files/ folder to the root of your Laravel project.

## Installation

Add ```"svpernova09/homesteadskeleton": "1.0.*``` to your project's ```composer.json``` in require-dev.
Run ```composer update```
Add to ```app/Providers/AppServiceProvider.php``` register() method:

```
if ($this->app->environment() == 'local') {
    $this->app->register('Svpernova09\HomesteadSkeleton\HomesteadSkeletonServiceProvider');
}
```

## Usage

Once you have followed the installation instructions:```php artisan homestead:create```.

This is designed to only be run once. If you run the command again you will overwrite files and any changes will be lost.
You are free to remove this package from Composer once you have your Homestead files in your project root.

For further Homestead configuration see [Official Documentation](http://laravel.com/docs/5.1/homestead)

## Caution

If you plan on using this in multiple projects or alongside Homestead's normal usage, ensure you change ```vb.name``` in ```src/scripts/homestead.rb``` to something unique.

If you ran ```php artisan homestead:create``` the ```vb.name``` will be something from the Inspire command.
