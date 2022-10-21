<?php

return [
    'global' => [
        'create'         => 'Criar',
        'edit'           => 'Editar',
        'delete'         => 'Excluir',
        'save'           => 'Salvar',
        'no_records'     => 'Nenhum registro encontrado.',
        'confirm_action' => 'Tem certeza?',
    ],

    'permissions' => [
        'title'  => 'Permissões',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nome',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ]
    ],

    'roles' => [
        'title'  => 'Funções',
        'fields' => [
            'id'          => 'ID',
            'name'        => 'Nome',
            'permissions' => 'Permissões',
            'created_at'  => 'Criado em',
            'updated_at'  => 'Atualizado em',
        ]
    ],

    'users' => [
        'title'  => 'Usuários',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nome',
            'email'      => 'E-mail',
            'roles'      => 'Funções',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ]
    ],
];
