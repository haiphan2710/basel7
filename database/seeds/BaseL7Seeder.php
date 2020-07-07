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
     * @return array
     */
    private function roles()
    {
        return Role::insert(config('basel7.seeders.roles'));
    }

    /**
     * Roles
     *
     * @return array
     */
    private function users()
    {
        $password = Hash::make(env('DEFAULT_USER_PASSWORD', 'secret'));
        $users    = collect(config('basel7.users'))->map(function ($user) use ($password) {
            $user->password = $password;

            return $user;
        })->toArray();

        return User::insert($users);
    }
}
