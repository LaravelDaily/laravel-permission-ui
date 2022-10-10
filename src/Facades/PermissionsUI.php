<?php

namespace LaravelDaily\PermissionsUI\Facades;

use Illuminate\Support\Facades\Facade;

class PermissionsUI extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'permissions-ui';
    }
}
