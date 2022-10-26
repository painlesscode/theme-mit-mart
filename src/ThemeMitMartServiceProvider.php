<?php

namespace Painlesscode\ThemeMitMart;

use Illuminate\Support\ServiceProvider;

class ThemeMitMartServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mit-mart');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/mit-mart'),
        ], 'public');
    }
}

