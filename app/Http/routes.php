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
    return view('app');
});

Route::post('oauth/access_token', function(){
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware'=>'oauth'], function(){

    Route::resource('cliente', 'ClientController', ['except' => ['create','edit']]);
    /*Route::get('cliente', ['middleware'=>'oauth','uses'=>'ClientController@index']);
    Route::post('cliente', 'ClientController@store');
    Route::get('cliente/{id}', 'ClientController@show');
    Route::delete('cliente/{id}', 'ClientController@destroy');
    Route::put('cliente/{id}', 'ClientController@update');*/

    //Route::group(['middleware'=>'CheckProjectOwner'], function(){
        Route::resource('project', 'ProjectController', ['except' => ['create','edit']]);
    //});

    Route::group(['prefix'=>'project'], function(){

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@delete');

        Route::post('{id}/file', 'ProjectFileController@store');
    });

    /*Route::get('project/{id}/note', 'ProjectNoteController@index');
    Route::post('project/{id}/note', 'ProjectNoteController@store');
    Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
    Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');
    Route::delete('project/{id}/note/{noteId}', 'ProjectNoteController@delete');*/

    /*Route::get('project', 'ProjectController@index');
    Route::post('project', 'ProjectController@store');
    Route::get('project/{id}', 'ProjectController@show');
    Route::delete('project/{id}', 'ProjectController@destroy');
    Route::put('project/{id}', 'ProjectController@update');*/

});
