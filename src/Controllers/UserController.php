<?php

namespace LaravelDaily\PermissionsUI\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('user_list');

        $users = User::with('roles')->paginate();

        return view('PermissionsUI::' . config('permission_ui.layout') . '.users.index', compact('users'));
    }

    public function create(): View
    {
        $this->authorize('user_create');

        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::' . config('permission_ui.layout') . '.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('user_create');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'roles' => ['nullable', 'array'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->input('roles'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
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
            'roles' => ['nullable', 'array'],
        ]);

        $user->syncRoles($request->input('roles'));

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('user_delete');

        $user->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }
}
