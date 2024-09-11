<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('setting', fn () => new \App\Models\Setting);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
