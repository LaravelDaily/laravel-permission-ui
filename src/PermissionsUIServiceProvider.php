<?php

namespace LaravelDaily\PermissionsUI;

use Illuminate\Support\ServiceProvider;

class PermissionsUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/permission_ui.php', 'permission_ui');
    }

    public function boot()
    {
        // registering routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // registering views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'PermissionsUI');

        // registering lang
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'PermissionsUI');

        // publish lang
        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/permission_ui'),
        ], 'lang');

        // publish config
        $this->publishes([
            __DIR__ . '/../config/permission_ui.php' => config_path('permission_ui.php'),
        ], 'config');

        // publish assets
        $this->publishes([
        __DIR__ . '/../public' => public_path('vendor/permission_ui'),
        ], ['permission_ui-assets', 'laravel-assets']);
    }
}
