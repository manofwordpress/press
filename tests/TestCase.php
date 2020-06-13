<?php
/**
 * Created by PhpStorm.
 * User: amrsharkas
 * Date: 12/06/2020
 * Time: 7:27 AM
 */

namespace sharkas\Press\Tests;

use sharkas\Press\PressBaseServiceProvider;

class TestCase  extends \Orchestra\Testbench\TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../database/factories');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        //this is to register our package service provider to be used in the testing
        return [
            PressBaseServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
       $app['config']->set('database.default','testdb');
       $app['config']->set('database.connections.testdb',[
           'driver' => 'sqlite',
           'database' => ':memory:'
       ]);
    }

}