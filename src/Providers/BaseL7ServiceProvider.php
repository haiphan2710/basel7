<?php

namespace HaiPhan\BaseL7\Providers;

use Carbon\Carbon;
use HaiPhan\BaseL7\Console\Commands\BaseL7Install;
use HaiPhan\BaseL7\Console\Commands\BaseL7ModelCommand;
use HaiPhan\BaseL7\Console\Commands\BaseL7SeedsCommand;
use HaiPhan\BaseL7\Console\Commands\BaseL7SetupCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class BaseL7ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->publishMigrations();
            $this->registerCommands();
            $this->passportSetting();
            $this->publishAuth();
            $this->publishCrudUser();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO
    }

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('passport:purge')->daily();
    }

    /**
     * Publishes migrations
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'basel7-migration');
    }

    /**
     * Publish Auth files
     *
     * @return void
     */
    protected function publishAuth()
    {
        $this->publishes([
            __DIR__.'/../Http/Controllers/AuthController.php' => app_path('Http/Controllers/AuthController.php'),
        ], 'basel7-setup-auth');
    }

    /**
     * Publish files for crud User
     *
     * @return void
     */
    protected function publishCrudUser()
    {
        $this->publishes([
            __DIR__.'/../Http/Controllers/UserController.php' => app_path('Http/Controllers/UserController.php'),
        ], 'basel7-setup-user');
    }

    /**
     * Publish Config with application
     *
     * @return void
     */
    protected function publishConfig()
    {
        // TODO
    }

    /**
     * Setting Passport
     *
     * @return void
     */
    protected function passportSetting()
    {
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }

    /**
     * Register commands with application
     */
    protected function registerCommands()
    {
        $this->commands([
            BaseL7Install::class,
            BaseL7ModelCommand::class,
            BaseL7SetupCommand::class,
            BaseL7SeedsCommand::class
        ]);
    }
}
