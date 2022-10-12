<?php

namespace LaravelDaily\PermissionsUI\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Permission\PermissionServiceProvider;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use LaravelDaily\PermissionsUI\PermissionsUIServiceProvider;

abstract class TestCase extends Orchestra
{
    use LazilyRefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('view.paths', array_merge(
            $app['config']->get('view.paths'),
            [__DIR__ . '/../resources/views'],
        ));
    }

    protected function getPackageProviders($app): array
    {
        return [
            PermissionServiceProvider::class,
            PermissionsUIServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        include_once __DIR__.'/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub';
        (new \CreatePermissionTables)->up();
    }
}
