<?php

use Illuminate\Support\Facades\Route;
use LaravelDaily\PermissionsUI\Controllers\RoleController;
use LaravelDaily\PermissionsUI\Controllers\PermissionController;
use LaravelDaily\PermissionsUI\Controllers\UserController;

Route::redirect(config('permission_ui.url_prefix'), config('permission_ui.url_prefix') . '/users');

Route::group([
    'middleware' => config('permission_ui.middleware'),
    'prefix'     => config('permission_ui.url_prefix'),
    'as'         => config('permission_ui.route_name_prefix')],
    function () {
        Route::resource('roles', RoleController::class)->except('show');
        Route::resource('permissions', PermissionController::class)->except('show');
        Route::resource('users', UserController::class)->only('index', 'edit', 'update');
    });
