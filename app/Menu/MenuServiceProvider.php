<?php

namespace App\Menu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require  __DIR__ . '/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/Views', 'wmenu');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wecodelaravel-menu', function () {
            return new WMenu();
        });

        // $this->app->make('Wecodelaravel\Menu\Controllers\MenuController');

        $this->mergeConfigFrom(
            config_path('menu.php'),
            'menu'
        );
    }
}
