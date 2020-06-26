<?php

namespace HaiPhan\BaseL7\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('key:generate');
        $this->info('Generated App Key.');

        Artisan::call('migrate:fresh', ['--seed' => true]);
        $this->info('Migrated and seeded all data.');

        Artisan::call('passport:install');
        $this->info('Installed Laravel Passport.');
    }
}
