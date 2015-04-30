<?php

use Pwnraid\Bnet\ClientFactory;
use Pwnraid\Bnet\Region;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('elevation', function(){
    return view('elevation.index');
});
Route::get('armoury/{realm}/{name}', function($realm, $name){
    $bnet = new ClientFactory('p7yu4pu7qsuu4nnr79cc3e3ae8akmwqe');
    $wow = $bnet->warcraft(new Region(Region::US));

    $toon = $wow->characters()->on('Frostmourne')->find('Shrom', ['feed', 'items']);
dd($toon['attributes']['name']);

    $wow = App::make('App\BattleNet\Wow');
    $guild = Cache::remember("$realm.$name", 1440, function() use ($wow, $realm, $name) {
        return
         $wow->guild($realm, $name, 'members, achievements');
    });
    $guild['members'] = new Illuminate\Support\Collection($guild['members']);
    //dd($guild['members']);
    $guild['members']->sort( function($a, $b){
        return $a['rank'] > $b['rank'];
    });
    $achievements = [];
    foreach($guild['achievements']['achievementsCompleted'] as $ach) {
        $achievement = Cache::remember("achievements.$ach", 43200, function() use($ach, $wow){
            return $wow->achievement($ach);
        });
        $achievements[] = $achievement;
    }
    $guild['achievements'] = $achievements;

    return view('battlenet.guild.index', compact('guild'));

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
