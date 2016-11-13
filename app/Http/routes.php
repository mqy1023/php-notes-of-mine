<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
// 1、get路由
Route::get('test1', function () {
    return 'test demo!';
});
// 2、post路由
Route::post('pp', function () {
    return 'pp demo!';
});
// 3、多请求路由
Route::match(['get', 'post'], 'test', function () {
    return 'match demo!';
});
// 4、响应所有类型路由
Route::any('any', function () {
    return 'any demo';
});

// 5、路由参数(user/xxx)
// Route::get('user/{id}', function ($id) {
//     return 'user--'.$id;
// });
//6、路由参数带默认值
// Route::get('student/{name?}', function ($name = '11') {
//     return 'student--'.$name;
// });
//7、路由参数值类型限定
Route::get('student/{name?}', function ($name = 'bean') {
    return 'student--'.$name;
})->where('name', '[A-Za-z]+'); // 限定参数只能是A-Z/a-z
// 8、多参数
Route::get('student/{id}/{name?}', function ($id, $name = 'bean') {
    return 'student-id-'.$id.'-name-'.$name;
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);

// 9、路由别名
// Route::get('user/center', ['as' => 'center', function () {
//     // 返回该路由地址:http://localhost:55/laravel/public/user/member-center
//     return route('center');
// }]);

// 10、路由群组
Route::group(['prefix' => 'member'], function () {
  Route::get('student', function () {
      return 'member-student'; // 访问: ..xxx/member/student
  });
  Route::get('user/center', ['as' => 'center', function () {
      // 返回该路由地址:http://localhost:55/laravel/public/user/member-center
      return route('center'); // 访问: ..xxx/member/user/center
  }]);
});
// 11、路由中输出视图
// Route::get('view', function () {
//     return view('welcome');
// });

// 12、路由关联控制器
// Route::get('info', 'MemberController@view');
Route::get('info', 'MemberController@viewInfos');
Route::get('infos', ['uses' => 'MemberController@info']);  // key must be 'uses'

Route::get('member', 'MemberController@member');

Route::any('orm', 'StudentController@orm4');

Route::get('section', 'MemberController@section');

Route::get('url', ['as' => 'url', 'use' => 'MemberController@urlTest']);

Route::get('test', 'MemberController@test');

Route::get('about', 'SitesController@blade');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
