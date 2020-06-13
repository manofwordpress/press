<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 12/06/2020
 * Time: 7:14 AM
 */

namespace sharkas\Press;

use function config_path;
use Illuminate\Support\ServiceProvider;
use sharkas\Press\Console\ProcessCommand;

class PressBaseServiceProvider extends ServiceProvider   //extends ServiceProvider  -->turn this class into laravel service provider
{

    public function boot()
    {
        if($this->app->runningInConsole())
        {
            $this->registerPublishing();
        }
        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            Console\ProcessCommand::class
        ]);
    }


    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/press.php' => config_path('press.php')  //what file get written to
        ],'press-config');
    }

}