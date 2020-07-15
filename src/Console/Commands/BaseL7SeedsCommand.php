<?php

namespace HaiPhan\BaseL7\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function () {
            $this->roles();
            $this->info('Created Roles!');

            $this->users();
            $this->info('Created Users!');
        });
    }

    /**
     * Roles
     *
     * @return void
     */
    private function roles()
    {
        $roles = [
            [
                'name'         => RoleEnum::OWNER,
                'display_name' => 'Owner Of System', // optional
                'description'  => 'Full power in the system', // optional
            ],
            [
                'name'         => RoleEnum::ADMIN,
                'display_name' => 'User Administrator', // optional
                'description'  => 'Manage all content', // optional
            ],
            [
                'name'         => RoleEnum::EDITOR,
                'display_name' => 'User Editor', // optional
                'description'  => 'User is allowed to manage contents', // optional
            ],
        ];

        collect($roles)->each(function ($role) {
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

        $users = [
            [
                'nickname' => 'admin_account',
                'email'    => 'admin@gmail.com',
                'password' => $password
            ],
            [
                'nickname' => 'test_account',
                'email'    => 'test@gmail.com',
                'password' => $password
            ],
        ];

        $userRole = [
            'admin_account' => RoleEnum::ADMIN,
            'test_account'  => RoleEnum::EDITOR
        ];

        collect($users)->each(function ($user) use ($userRole) {

            $new  = User::create($user);
            $role = $userRole[$user['nickname']];

            $new->attachRole($role);
        });
    }
}
