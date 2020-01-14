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

Route::get('estancias', 'EstanciaController@index');
Route::get('estancias/{id}','EstanciaController@show');
Route::post('estancias', 'EstanciaController@store');
Route::put('estancias/{id}', 'EstanciaController@update');
Route::delete('estancias/{id}', 'EstanciaController@delete');

//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout');
//Route::post('register', 'Auth\RegisterController@registered');
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => ['jwt.verify']], function() {
   
});

Route::get('users', 'UserController@index');
Route::get('users/{id}','UserController@show');
Route::post('users', 'UserController@store');
Route::put('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@delete');