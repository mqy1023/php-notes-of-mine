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

Route::get('request1', 'StudentController@request1');

Route::group(['middleware' => ['web']], function() {
    Route::get('session1', 'StudentController@session1');
    Route::get('session2', [
        'as' => 'session2',
        'uses' => 'StudentController@session2'
    ]);
    // Route::get('session2', 'StudentController@session2');
    Route::get('response', 'StudentController@response');
});

// 宣传页面
Route::get('activity0', 'StudentController@activity0');
// 要经过中间件过滤的activity~
Route::group(['middleware' => ['activity']], function() {
    Route::get('activity1', 'StudentController@activity1');
    Route::get('activity2', 'StudentController@activity2');
});

Route::group(['middleware' => ['web']], function() {
    Route::get('student/index', ['uses' => 'StudentsController@index']);
    Route::any('student/create', ['uses' => 'StudentsController@create']);
    Route::any('student/save', ['uses' => 'StudentsController@save']);
    Route::any('student/update/{id}', ['uses' => 'StudentsController@update']);
    Route::any('student/detail/{id}', ['uses' => 'StudentsController@detail']);
    Route::any('student/delete/{id}', ['uses' => 'StudentsController@delete']);
});
