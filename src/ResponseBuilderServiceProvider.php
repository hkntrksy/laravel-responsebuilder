<?php

namespace Turksoy\ResponseBuilder;

use Illuminate\Support\ServiceProvider;

class ResponseBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerHelpers();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('responsebuilder', function () {
            return new ResponseBuilder;
        });
    }

    /**
     * Register helpers file
     */
    public function registerHelpers()
    {
        require_once __DIR__.'/helpers.php';
    }

}
