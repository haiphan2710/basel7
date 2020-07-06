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
    protected $signature = 'basel7:install
                            {--setting : Setting Config, Migration, Seeder}';

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
        if ($this->option('setting')) {
            $this->publishSettingBaseL7();
        }

        Artisan::call('migrate:fresh', ['--seed' => true]);
        $this->info('Migrated and seeded all data.');

        Artisan::call('passport:install');
        $this->info('Installed Laravel Passport.');
    }

    protected function publishSettingBaseL7()
    {
        $this->call('vendor:publish', ['--tag' => 'basel7-config']);
        $this->call('vendor:publish', ['--tag' => 'basel7-migration']);
        $this->call('vendor:publish', ['--tag' => 'basel7-seeder']);
    }
}
