<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        // Bind the SettingHelper to 'setting'
        $this->app->singleton('setting', function () {
            // Load all settings into the cache once and forever
            return Cache::rememberForever('settings', function () {
                return Setting::pluck('value', 'key')->all();
            });
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
