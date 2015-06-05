<?php

namespace Svpernova09\HomesteadSkeleton;

use Illuminate\Support\ServiceProvider;

class HomesteadSkeletonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHomesteadCreate();
    }

    /**
     * Register the homestead:create command.
     */
    private function registerHomesteadCreate()
    {
        $this->app->singleton('command.homestead.create', function ($app) {
            return $app['Svpernova09\HomesteadSkeleton\Commands\HomesteadCreateCommand'];
        });

        $this->commands('command.homestead.create');
    }




}