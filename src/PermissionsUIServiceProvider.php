<?php

namespace LaravelDaily\PermissionsUI;

use Illuminate\Support\ServiceProvider;

class PermissionsUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/permission-ui.php', 'permission-ui');
    }

    public function boot()
    {
        // registering routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // registering views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'PermissionsUI');

        // registering lang
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'PermissionsUI');

        // publish config
        $this->publishes([
            __DIR__ . '/../config/permission-ui.php' => config_path('permission-ui.php'),
        ], 'config');
    }
}
