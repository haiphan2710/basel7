<?php

namespace HaiPhan\BaseL7\Providers;

use Carbon\Carbon;
use HaiPhan\BaseL7\Console\Commands\BaseL7Install;
use HaiPhan\BaseL7\Console\Commands\BaseL7ModelCommand;
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
            $this->publishSeeder();
            $this->registerCommands();
            $this->passportSetting();
        }
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
     * Load migrations
     */
    protected function publishSeeder()
    {
        $this->publishes([
            __DIR__.'/../../database/seeds' => database_path('seeds'),
        ], 'basel7-seeder');
    }

    /**
     * Register commands with application
     */
    protected function registerCommands()
    {
        $this->commands([
            BaseL7Install::class,
            BaseL7ModelCommand::class,
        ]);
    }

    /**
     * Publish Config with application
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/basel7.php' => config_path('basel7.php'),
        ], 'basel7-config');
        $this->publishes([
            __DIR__.'/../../config/laratrust.php' => config_path('laratrust.php'),
        ], 'basel7-config');
        $this->publishes([
            __DIR__.'/../../config/laratrust_seeder.php' => config_path('laratrust_seeder.php'),
        ], 'basel7-config');
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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO
    }
}
