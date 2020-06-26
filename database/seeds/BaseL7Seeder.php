<?php


use Illuminate\Database\Seeder;

use HaiPhan\BaseS7\Enums\Role as RoleEnum;

class BaseL7Seeder extends Seeder
{
    /**
     * Roles
     *
     * @return array
     */
    private function roles()
    {
        return [
            Role::create([
                'name'         => RoleEnum::OWNER,
                'display_name' => 'Owner Of System', // optional
                'description'  => 'Full power in the system', // optional
            ]),
            Role::create([
                'name'         => RoleEnum::ADMIN,
                'display_name' => 'User Administrator', // optional
                'description'  => 'Manage all content', // optional
            ]),
            Role::create([
                'name'         => RoleEnum::EDITOR,
                'display_name' => 'User Editor', // optional
                'description'  => 'User is allowed to manage contents', // optional
            ]),
        ];
    }
}
