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

Route::get('/', function () {
    return view('welcome');
});

Route::get('cliente', 'ClientController@index');
Route::post('cliente', 'ClientController@store');
Route::get('cliente/{id}', 'ClientController@show');
Route::delete('cliente/{id}', 'ClientController@destroy');
Route::put('cliente/{id}', 'ClientController@update');