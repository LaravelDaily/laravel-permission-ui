<?php

namespace LaravelDaily\PermissionsUI;

use Illuminate\Support\ServiceProvider;
use LaravelDaily\PermissionsUI\Commands\InstallCommand;

class PermissionsUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/permission_ui.php', 'permission_ui');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }

    public function boot()
    {
        // registering routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // registering views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'PermissionsUI');

        // publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/permission_ui'),
        ], 'views');

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

        // publish seed
        $this->publishes([
            __DIR__ . '/../database/seeders' => database_path('seeders'),
        ], 'seeds');
    }
}
