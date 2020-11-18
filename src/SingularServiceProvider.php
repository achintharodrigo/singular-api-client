<?php


namespace AchinthaRodrigo\SingularApiClient;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SingularServiceProvider extends ServiceProvider
{
    public function boot() :void
    {
        $this->publishes([
            __DIR__.'/../config/singular.php' => config_path('singular.php')
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/singular.php',
            'singular'
        );

        $this->app->singleton('singular', function (Application $app): Singular {
            return $app->make(Singular::class);
        });
    }
}
