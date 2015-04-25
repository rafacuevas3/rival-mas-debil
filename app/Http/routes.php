<?php

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
use App\Resultado as Resultado;

Route::get('/', 'JuegoController@index');
Route::get('/ronda_final', 'JuegoController@ronda_final');


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('json_puntaje/{points}/{round}', function($points, $round){
	$resultado = Resultado::create(['ronda' => $round , 'puntos' => $points]);
	return 'Hecho';
});