<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Admin'])
            ->syncPermissions([
                Permission::create(['name' => 'user_list']),
                Permission::create(['name' => 'user_create']),
                Permission::create(['name' => 'user_edit']),
                Permission::create(['name' => 'user_delete']),
            ]);

        Role::create(['name' => 'User'])->givePermissionTo('user_list');
    }
}
