<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'AuthController@user');
    });
});

//estancias
Route::get('estancias', 'EstanciaController@index');
Route::get('estancias/{id}','EstanciaController@show');
Route::post('estancias', 'EstanciaController@store');
Route::put('estancias/{id}', 'EstanciaController@update');
Route::delete('estancias/{id}', 'EstanciaController@delete');

//users
Route::get('users', 'UserController@index');
Route::get('users/{id}','UserController@show');
Route::post('users', 'UserController@store');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@delete');
Route::get('clientes', 'UserController@showClientes');
Route::get('recepcionistas', 'UserController@showRecepcionistas');

//reservas
Route::get('reservas/{id}','ReservaController@show');
Route::post('reservas','ReservaController@store');
Route::put('reservas/{id}', 'ReservaController@update');
Route::delete('reservas/{id}','ReservaController@delete');

//tiposEstancias
Route::get('tipoestancias','TipoEstanciaController@index');
Route::get('tipoestancias/{id}','TipoEstanciaController@show');
Route::post('tipoestancias','TipoEstanciaController@store');
Route::put('tipoestancias/{id}', 'TipoEstanciaController@update');
Route::delete('tipoestancias/{id}','TipoEstanciaController@delete');

//tiposReservas(pensiones)
Route::get('tiporeservas','TipoReservaController@index');
Route::get('tiporeservas/{id}','TipoReservaController@show');
Route::post('tiporeservas','TipoReservaController@store');
Route::put('tiporeservas/{id}', 'TipoReservaController@update');
Route::delete('tiporeservas/{id}','TipoReservaController@delete');

//Temporadas
Route::get('temporadas','TemporadasController@index');
Route::get('temporadas/{id}','TemporadasController@show');
Route::post('temporadas','TemporadasController@store');
Route::put('temporadas/{id}', 'TemporadasController@update');
Route::delete('temporadas/{id}','TemporadasController@delete');
