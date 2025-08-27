<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FilamentNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Ensure notifications are sent to the correct model based on the guard
        $this->app->extend('filament.notifications', function ($manager, $app) {
            return $manager;
        });
    }
}
