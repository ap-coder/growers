<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local', 'development')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        if ($this->app->environment('local', 'development', 'staging')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->isLocal()) {
            Auth::login(User::first());
        }
    }
}
