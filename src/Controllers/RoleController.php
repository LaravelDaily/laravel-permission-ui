<?php

namespace LaravelDaily\PermissionsUI\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')->get();

        return view('PermissionsUI::roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        $role->givePermissionTo($request->input('permissions'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }
}
