<?php

use App\Models\Role;
use App\Models\User;
use HaiPhan\BaseL7\Enums\Role as RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BaseL7Seeder extends Seeder
{
    /** @var array $roles */
    protected $roles = [];

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
        collect(config('basel7.seeds.roles'))->each(function ($role) {
            $this->roles[] = Role::create($role);
        });

        $this->roles = collect($this->roles);
    }

    /**
     * Roles
     *
     * @return void
     */
    private function users()
    {
        $password = Hash::make(env('DEFAULT_USER_PASSWORD', 'secret'));

        collect(config('basel7.seeds.users'))->each(function ($user) use ($password) {
            $user['password'] = $password;

            $new = User::create($user);

            $role = ($user['nickname'] == 'admin_account')
                ? RoleEnum::ADMIN
                : RoleEnum::EDITOR;

            $new->attachRole($this->roles->where('name', $role)->first());
        });
    }
}
