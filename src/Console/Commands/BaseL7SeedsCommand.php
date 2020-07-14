<?php

namespace HaiPhan\BaseL7\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use HaiPhan\BaseL7\Enums\Role as RoleEnum;

class BaseL7SeedsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'basel7:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'BaseL7 make dummy data';

    /** @var array $roles */
    protected $roles = [];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->roles();
        $this->info('Created Roles!');

        $this->users();
        $this->info('Created Users!');
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
