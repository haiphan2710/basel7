<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BaseL7Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles();
        $this->users();
    }

    /**
     * Roles
     *
     * @return void
     */
    private function roles()
    {
        collect(config('basel7.seeders.roles'))->each(function ($role) {
            Role::create($role);
        });
    }

    /**
     * Roles
     *
     * @return void
     */
    private function users()
    {
        $password = Hash::make(env('DEFAULT_USER_PASSWORD', 'secret'));

        collect(config('basel7.seeders.users'))->each(function ($user) use ($password) {
            $user['password'] = $password;

            User::create($user);
        });
    }
}
