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
        $this->loadLaravelMigrations();

        include_once __DIR__.'/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub';
        (new \CreatePermissionTables)->up();
    }
}
