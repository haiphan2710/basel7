<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class BaseL7Seeder extends Seeder
{
    /** @var string $roleModel */
    protected $roleModel = Role::class;

    /** @var string $userModel */
    protected $userModel = User::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles();
    }

    /**
     * Roles
     *
     * @return array
     */
    private function roles()
    {
        return $this->roleModel::insert(config('basel7.seeders'));
    }

    /**
     * Roles
     *
     * @return array
     */
    private function users()
    {
        return $this->userModel::insert(config('basel7.users'));
    }
}
