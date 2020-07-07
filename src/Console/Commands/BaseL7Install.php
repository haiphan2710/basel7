<?php

namespace HaiPhan\BaseL7\Console\Commands;

use Illuminate\Console\Command;

class BaseL7Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'basel7:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install BaseL7 App';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->publishSettingBaseL7();
        $this->info('Publish configurations, migrations and seeds');

        $this->call('laratrust:role');
        $this->info('Create Role model');

        $this->call('migrate:fresh', ['--seed' => true]);
        $this->info('Migrated and seeded all data.');

        $this->call('passport:install', ['--force']);
        $this->info('Installed Laravel Passport.');

        $this->call('basel7:model', ['name' => 'Models/User', '--auth' => true]);
        $this->info('Create User model');

        $this->call('db:seed', ['--class' => 'BaseL7Seeder']);
        $this->info('Executed BaseL7Seeder');
        $this->info('Installed Package!');
    }

    protected function publishSettingBaseL7()
    {
        $this->call('vendor:publish', ['--tag' => 'basel7-config']);
        $this->call('vendor:publish', ['--tag' => 'basel7-migration']);
        $this->call('vendor:publish', ['--tag' => 'basel7-seeder']);
    }
}
