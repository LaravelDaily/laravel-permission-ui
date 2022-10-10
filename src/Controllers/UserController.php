<?php

namespace LaravelDaily\PermissionsUI\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->get();

        return view('PermissionsUI::users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'roles' => ['required', 'array'],
        ]);

        $user->syncRoles($request->input('roles'));

        return redirect()->route(config('permissions.route_name_prefix') . 'users.index');
    }
}
