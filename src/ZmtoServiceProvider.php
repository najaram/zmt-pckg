<?php

namespace Najaram\Zmto;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ZmtoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zmto.php', 'zmto');

        // Register the service the package provides.
        $this->app->singleton(Zmto::class, function () {
            $client = new Client([
                'base_uri' => 'https://developers.zomato.com/api/v2.1/',
            ]);

            return new Zmto($client);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['zmto'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/zmto.php' => config_path('zmto.php'),
        ], 'zmto.config');
    }
}
