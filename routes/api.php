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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('estancias', 'EstanciaController@index');
Route::get('estancias/{id}','EstanciaController@show');
Route::post('estancias', 'EstanciaController@store');
Route::put('estancias/{id}', 'EstanciaController@update');
Route::delete('estancias/{id}', 'EstanciaController@delete');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('users', 'UserController@index');
Route::get('users/{id}','UserController@show');
Route::post('users', 'UserController@store');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@delete');

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
Route::get('tiporeservas/{id}','TemporadasController@show');
Route::post('tiporeservas','TemporadasController@store');
Route::put('tiporeservas/{id}', 'TemporadasController@update');
Route::delete('tiporeservas/{id}','TemporadasController@delete');
