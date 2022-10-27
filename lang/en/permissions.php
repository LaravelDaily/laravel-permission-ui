<?php

return [
    'global' => [
        'create'         => 'Create',
        'edit'           => 'Edit',
        'delete'         => 'Delete',
        'save'           => 'Save',
        'no_records'     => 'No records.',
        'confirm_action' => 'Are you sure?',
    ],

    'permissions' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'         => 'ID',
            'name'       => 'Name',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
    ],

    'roles' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'          => 'ID',
            'name'        => 'Name',
            'permissions' => 'Permissions',
            'created_at'  => 'Created at',
            'updated_at'  => 'Updated at',
        ],
    ],

    'users' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'         => 'ID',
            'name'       => 'Name',
            'email'      => 'Email',
            'password'   => 'Password',
            'roles'      => 'Roles',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
    ],
];
