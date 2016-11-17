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

Route::auth();

Route::get('/home', 'HomeController@index');

Route::any('upload', 'StudentController@upload');

Route::any('mail', 'StudentController@mail');

Route::any('cache1', 'StudentController@cache1');
Route::any('cache2', 'StudentController@cache2');
Route::any('error', 'StudentController@error');
Route::any('log', 'StudentController@log');
Route::any('queue', 'StudentController@queue');
