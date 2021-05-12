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

Route::get('/', ['as' => 'home', 'uses' => 'RespuestasController@create']);
Route::post('/store-1', [ 'uses' => 'RespuestasController@store1']);
Route::get('/create-2/{id}', ['uses' => 'RespuestasController@create2']);
Route::post('/store-2/{id}', ['uses' => 'RespuestasController@store2']);
Route::get('/create-3/{id}', ['uses' => 'RespuestasController@create3']);
Route::post('/store-3/{id}', ['uses' => 'RespuestasController@store3']);
Route::get('/create-4/{id}', ['uses' => 'RespuestasController@create4']);
Route::post('/store-4/{id}', ['uses' => 'RespuestasController@store4']);
Route::get('/create-5/{id}', ['uses' => 'RespuestasController@create5']);
Route::post('/store-5/{id}', ['uses' => 'RespuestasController@store5']);
Route::get('/create-6/{id}', ['uses' => 'RespuestasController@create6']);
Route::post('/store-6/{id}', ['uses' => 'RespuestasController@store6']);
Route::get('/create-7/{id}', ['uses' => 'RespuestasController@create7']);
Route::post('/store-7/{id}', ['uses' => 'RespuestasController@store7']);
Route::get('/create-8/{id}', ['uses' => 'RespuestasController@create8']);
Route::post('/store-8/{id}', ['uses' => 'RespuestasController@store8']);
Route::get('/final/{id}', ['uses' => 'RespuestasController@finalForm']);
Route::post('/final-store/{id}', ['uses' => 'RespuestasController@finalStore']);
Route::get('/results/{id}', ['uses' => 'RespuestasController@results']);
Route::get('/show/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB/{id}', ['uses' => 'RespuestasController@show']);

Route::get('/index/OQmQFVAZPTfCIhG841rd/h2oGhrRZg9i1IWcxSD59/uyIPinGYZi3qdRTAbXvB', ['uses' => 'RespuestasController@index']);
