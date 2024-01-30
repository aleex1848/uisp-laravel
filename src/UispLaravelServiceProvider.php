<?php

namespace Aleex1848\UispLaravel;

use Aleex1848\UispLaravel\Client;
use Illuminate\Support\ServiceProvider;

class UispLaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('uisp-laravel', function($app) {
            return new Client();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'uisp-laravel');

    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('uisp-laravel.php'),
            ], 'config');

        }
    }
}
