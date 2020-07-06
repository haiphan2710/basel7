<?php

namespace HaiPhan\BaseL7\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Commands to call with their description.
     *
     * @var array
     */
    protected $calls = [
        'key:generate' => 'Generated App Key.',
        'laratrust:role' => 'Creating Role model',
        'laratrust:permission' => 'Creating Permission model',
        'laratrust:add-trait' => 'Adding LaratrustUserTrait to User model'
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('migrate:fresh', ['--seed' => true]);
        $this->info('Migrated and seeded all data.');

        Artisan::call('passport:install');
        $this->info('Installed Laravel Passport.');
    }
    /**
     * Get the seeder path.
     *
     * @return string
     */
    protected function seederPath()
    {
        return database_path("seeds/LaratrustSeeder.php");
    }
}
