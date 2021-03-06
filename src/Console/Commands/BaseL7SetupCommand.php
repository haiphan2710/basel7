<?php

namespace HaiPhan\BaseL7\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class BaseL7SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'basel7:setup
                            {--auth: Create APIs for base authentication}
                            {--user: Create APIs for CRUD User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'BaseL7 Setup Something';


    /**
     * BaseL7SetupCommand constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);

        $this->addOption('auth');
        $this->addOption('user');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('auth')) {
            $this->setupAuth();
            return;
        }

        if ($this->option('user')) {
            $this->setupCrudUser();
            return;
        }
    }

    /**
     * Setup Login API
     */
    protected function setupAuth()
    {
        $this->call('vendor:publish', ['--tag' => 'basel7-setup-auth']);
    }

    /**
     * Setup CRUD User APIs
     */
    protected function setupCrudUser()
    {
        $this->call('vendor:publish', ['--tag' => 'basel7-setup-user']);
    }
}
