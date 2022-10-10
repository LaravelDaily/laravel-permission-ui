<?php

namespace LaravelDaily\PermissionsUI\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.permissions.index', compact('permissions'));
    }

    public function create() {
        $roles = Role::pluck('name', 'id');

        return view('permissions.permissions.create', compact('roles'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permission = Permission::create($data);

        $permission->syncRoles($request->input('roles'));

        return redirect()->route(config('permissions.route_name_prefix') . 'permissions.index');
    }

    public function edit(Permission $permission) {
        $roles = Role::pluck('name', 'id');

        return view('permissions.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permission->update($data);

        $permission->syncRoles($request->input('roles'));

        return redirect()->route(config('permissions.route_name_prefix') . 'permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route(config('permissions.route_name_prefix') . 'permissions.index');
    }
}
