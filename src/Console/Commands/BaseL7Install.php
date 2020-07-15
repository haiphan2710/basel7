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

        $this->call('migrate:fresh', ['--seed' => true]);
        $this->info('Migrated and seeded all data.');

        $this->call('passport:install', ['--force' => true]);
        $this->info('Installed Laravel Passport.');

        $this->createModels();
        $this->makeDummyData();

        $this->info('Installed Package!');
    }

    /**
     * Publish Setting Files
     *
     * @return void
     */
    protected function publishSettingBaseL7()
    {
//        $this->call('vendor:publish', ['--tag' => 'basel7-config']);
        $this->call('vendor:publish', ['--tag' => 'basel7-migration']);
    }

    /**
     * Create Models
     *
     * @return void
     */
    protected function createModels()
    {
        $this->call('basel7:model', ['name' => 'Models/User', '--auth' => true]);
        $this->call('basel7:model', ['name' => 'Models/Role']);
        $this->info('Created models');
    }

    /**
     * Make data dummy (roles, users)
     *
     * @return void
     */
    protected function makeDummyData()
    {
        $this->call('basel7:seed');
        $this->info('Created Roles: Owner, Admin, Editor');
        $this->info('Created User: admin@gmail.com | secret');
        $this->info('Created User: test@gmail.com | secret');
    }
}
