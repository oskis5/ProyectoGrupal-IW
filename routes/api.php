<?php

use Illuminate\Http\Request;
use App\Estancia;
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
