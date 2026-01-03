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

        // Register Telescope in all environments
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->isLocal() && !Auth::check()) {
            $userId = env('LOCAL_AUTO_LOGIN_USER_ID', 1);
            $user = User::find($userId);
            if ($user) {
                Auth::login($user);
            }
        }

    }
}
