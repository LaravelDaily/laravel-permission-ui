<?php

namespace LaravelDaily\PermissionsUI\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('user_list');

        $users = User::with('roles')->paginate();

        return view('PermissionsUI::' . config('permission_ui.layout') . '.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $this->authorize('user_edit');

        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::' . config('permission_ui.layout') . '.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('user_edit');

        $request->validate([
            'roles' => ['required', 'array'],
        ]);

        $user->syncRoles($request->input('roles'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }
}
