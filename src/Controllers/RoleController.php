<?php

namespace LaravelDaily\PermissionsUI\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('PermissionsUI::roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        $role->givePermissionTo($request->input('permissions'));

        return redirect()->route(config('permissions.route_name_prefix') . 'roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route(config('permissions.route_name_prefix') . 'roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route(config('permissions.route_name_prefix') . 'roles.index');
    }
}
