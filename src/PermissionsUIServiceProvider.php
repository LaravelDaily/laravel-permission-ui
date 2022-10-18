<?php

namespace LaravelDaily\PermissionsUI;

use Illuminate\Support\ServiceProvider;

class PermissionsUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/permissions.php', 'permissions');
    }

    public function boot()
    {
        // registering routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // registering views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'PermissionsUI');

        // registering lang
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'PermissionsUI');

        // publish config
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

        // publish assets
        $this->publishes([
        __DIR__ . '/../public' => public_path('vendor/permission_ui'),
        ], ['permission_ui-assets', 'laravel-assets']);
    }
}
