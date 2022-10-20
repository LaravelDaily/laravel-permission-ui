<?php

namespace LaravelDaily\PermissionsUI\Tests;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use LaravelDaily\PermissionsUI\Tests\Models\User;

class PermissionsTest extends TestCase
{
    public function testRedirectUrlPrefixToUsersList()
    {
        $response = $this->actingAs(User::factory()->create())->get(config('permission_ui.url_prefix'));

        $response->assertRedirect(route(config('permission_ui.route_name_prefix') . 'users.index'));
    }

    public function testPermissionCanBeAttachedToRole()
    {
        $permission = Permission::create(['name' => 'permission']);

        $response = $this->actingAs(User::factory()->create())->post(route(config('permission_ui.route_name_prefix') . 'roles.store'), [
            'name'        => 'role',
            'permissions' => [$permission->id],
        ]);

        $response->assertRedirect(route(config('permission_ui.route_name_prefix') . 'roles.index'));

        $this->assertTrue(Role::first()->hasPermissionTo($permission));
    }

    public function testPermissionsShowsOnCreateAndEditRolePages()
    {
        $user = User::factory()->create();

        Permission::create(['name' => 'create user']);

        $response = $this->actingAs($user)->get(route(config('permission_ui.route_name_prefix') . 'roles.create'));

        $response->assertOk()
            ->assertViewHas('permissions', function (Collection $permissions) {
                foreach ($permissions as $permission) {
                    return $permission === 'create user';
                }
            });

        $role = Role::create(['name' => 'admin']);

        $response = $this->actingAs($user)->get(route(config('permission_ui.route_name_prefix') . 'roles.edit', $role));

        $response->assertOk()
            ->assertViewHas('permissions', function (Collection $permissions) {
                foreach ($permissions as $permission) {
                    return $permission === 'create user';
                }
            });
    }

    public function testWhenCreatingPermissionItCanBeAssignedToRole()
    {
        $role = Role::create(['name' => 'admin']);

        $response = $this->actingAs(User::factory()->create())->post(route(config('permission_ui.route_name_prefix') . 'permissions.store'), [
            'name'  => 'create user',
            'roles' => [$role->id],
        ]);

        $response->assertRedirect(route(config('permission_ui.route_name_prefix') . 'permissions.index'));

        $this->assertTrue(Permission::first()->hasRole($role));
    }

    public function testWhenEditingPermissionItCanBeAssignedToRole()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create user']);

        $response = $this->actingAs(User::factory()->create())->patch(route(config('permission_ui.route_name_prefix') . 'permissions.update', $permission), [
            'name'  => 'create_user',
            'roles' => [$role->id],
        ]);

        $response->assertRedirect(route(config('permission_ui.route_name_prefix') . 'permissions.index'));

        $this->assertTrue(Permission::first()->hasRole($role));

        $this->assertDatabaseHas('permissions', [
            'name' => 'create_user',
        ]);
    }
}
