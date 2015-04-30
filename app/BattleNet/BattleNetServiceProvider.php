<?php namespace App\BattleNet;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as Client;

class BattleNetServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\BattleNet\Wow', function($app) {
            return new \App\BattleNet\Wow( new Client(), 'https://us.api.battle.net/wow/', 'p7yu4pu7qsuu4nnr79cc3e3ae8akmwqe' );
        });
    }

}
