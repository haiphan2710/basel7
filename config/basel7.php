<?php

use HaiPhan\BaseL7\Enums\Role;

return [
    'seeders' => [
        'roles' => [
            [
                'name'         => Role::OWNER,
                'display_name' => 'Owner Of System', // optional
                'description'  => 'Full power in the system', // optional
            ],
            [
                'name'         => Role::ADMIN,
                'display_name' => 'User Administrator', // optional
                'description'  => 'Manage all content', // optional
            ],
            [
                'name'         => Role::EDITOR,
                'display_name' => 'User Editor', // optional
                'description'  => 'User is allowed to manage contents', // optional
            ],
        ],
        'users' => [
            [
                'nickname' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => ''
            ],
            [
                'nickname' => 'test_account',
                'email'    => 'test@gmail.com',
                'password' => ''
            ],
        ]
    ]
];
