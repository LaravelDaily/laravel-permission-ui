<?php

use Illuminate\Support\Facades\Route;
use LaravelDaily\PermissionsUI\Controllers\RoleController;
use LaravelDaily\PermissionsUI\Controllers\PermissionController;
use LaravelDaily\PermissionsUI\Controllers\UserController;

Route::redirect(config('permissions.url_prefix'), 'users');

Route::group([
    'middleware' => config('permissions.middleware'),
    'prefix'     => config('permissions.url_prefix'),
    'as'         => config('permissions.route_name_prefix')],
    function () {
        Route::resource('roles', RoleController::class)->except('show');
        Route::resource('permissions', PermissionController::class)->except('show');
        Route::resource('users', UserController::class)->only('index', 'edit', 'update');
    });
