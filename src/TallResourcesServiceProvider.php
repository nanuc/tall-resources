<?php

namespace Nanuc\TallResources;

use Illuminate\Support\ServiceProvider;

class TallResourcesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tall-resources.php' => base_path('config/tall-resources.php')
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tall-resources');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tall-resources.php', 'tall-resources');
    }
}
