# laravel基础
* 1、环境安装
* 2、路由
* 3、MVC(Model、Controller、View)
* 4、数据库
  * DB facade(原始查找)
  * 查询构造器
  * Eloquent ORM
* 5、blade模板引擎
* 6、使用 Artisan 工具
  * Migration
  * Seeder（数据填充)

## 《一》、环境安装
* 1、下载MAMP并安装.
* 2、下载一键安装包, 放在MAMP服务器根地址下
[laravel一键安装包](http://www.golaravel.com/download/)

另外一种安装方式可参考[README安装.md](./README安装.md)

## 《二》、laravel基础(一) ———— 路由和MVC
#### 一、路由
  * 1、路由简介.
  在app/Http/routes.php.

  * 2、基本路由
  ```
  // 1、get路由
  Route::get('test1', function () {
      return 'test demo!';
  });
  // 2、post路由
  Route::post('pp', function () {
      return 'pp demo!';
  });
  ```
  * 3、多请求路由
  ```
  // 3、多请求路由
  Route::match(['get', 'post'], 'test', function () {
      return 'match demo!';
  });
  // 4、响应任意类型路由
  Route::any('any', function () {
      return 'any demo';
  });
  ```
  * 4、路由参数
  ```
  // 5、路由参数(user/xxx)
  Route::get('user/{id}', function ($id) {
      return 'user--'.$id;
  });
  //6、路由参数带默认值
  // Route::get('student/{name?}', function ($name = '11') {
  //     return 'student--'.$name;
  // });
  // 7、路由参数值类型限定
  Route::get('student/{name?}', function ($name = 'bean') {
      return 'student--'.$name;
  })->where('name', '[A-Za-z]+'); // 限定参数只能是A-Z/a-z
  // 8、多参数
  Route::get('student/{id}/{name?}', function ($id, $name = 'bean') {
      return 'student-id-'.$id.'-name-'.$name;
  })->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);
  ```
  * 5、路由别名
  ```
  // 9、路由别名
  Route::get('user/center', ['as' => 'center', function () {
      // 返回该路由地址:http://localhost:55/laravel/public/user/member-center
      return route('center');
  }]);
  ```
  * 6、路由群组
  ```
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
  ```
  * 7、路由中输出视图
  ```
  // 11、路由中输出视图
  Route::get('view', function () {
      return view('welcome');
  });
  ```
#### 二、控制器
路径: app/Http/Controllers.

* 1、新建一个控制器
```
<?php
namespace App\Http\Controllers; // 命名空间
class MemberController extends Controller {
    public function info() {
        return 'member-info';
    }
}
```
* 2、路由关联控制器
```
Route::get('info', 'MemberController@info'); // 方式一
Route::get('infos', ['uses' => 'MemberController@info']); // 方式二(key must be 'uses')
// a、配合路由别名
Route::get('infoss', [
    'uses' => 'MemberController@info',
    'as' => 'memberinfo'
]);
// b、配合路由参数
Route::get('info/{id}', 'uses' => 'MemberController@getId')->where('id', '[0-9]+');
```
#### 三、视图
路径: resources/views/*

* 1、怎样新建视图
info.php / info.blade.php(在resources/views/member/目录下)
* 2、怎样输出视图
  * a、在routers.php中 `Route::get('info', 'MemberController@viewInfo');`
  * b、在MemberController.php中
    ```
    // 视图
    public function viewInfo() {
        return view('info');
    }
    // blade 模板
    public function viewInfos() { // 对应模板路径: resources/views/member/
      return view('member/info', [
          'name' => 'china',
          'age' => 18
        ]);
    }
    ```
  * 3、向视图中传递变量三种方式
    * a、第二个参数传递
  ```
  public function section() {
    $name = 'haha';
    $arr = ['aaa', 'bbb', 'haha'];
    return view('member.info', [
        'name' => $name,
        'arr' => $arr,
      ]
    );
  }
  ```
    * b、with方式传递
  ```
  public function test() {
    $name = 'haha';
    return view('member.test')->with('name', $name);
  }
  ```
    * c、compact方式传递
  ```
  $name = 'haha';
  return view('member.test', compact('name'));
  ```
  * 4、视图中的输出
  ```
  <!-- 1、模板中输出PHP变量 -->
  <p>{{ $name }}</p>
  <!-- 2、模板中调用php代码 -->
  <p>{{ time() }}</p>
  <p>{{ date('Y-m-d H:i:s', time()) }}</p>

  <p>{{ in_array($name, $arr) ? 'true' : 'false' }}</p>
  <p>{{ isset($name) ? $name : 'default' }}</p>
  <p>{{ $name or 'default' }}</p>

  <!-- 3、原样输出 -->
  <p>@{{ $name }}</p>

  <!-- 4、非转义输出 -->
  <p>{!! $name !!}</p>

  {{-- 5、模板中注释 --}}

  {{-- 6、引入子视图 include --}}
  @include('member.child', ['msg' => '我是父信息'])

  {{-- 7、流程控制 --}}
  @if ($name = 'sean11')
      i'm sean
  @elseif ($name = 'haha')
      i'm haha
  @else
      who am i
  @endif

  @unless($name == 'sean')
      i'm sean!!
  @endunless

  @for($i=0; $i < 2; $i++)
      <p>{{$i}}</p>
  @endfor

  @foreach($students as $student)
      <p>{{ $student->name }}</p>
  @endforeach

  @forelse($students as $student)
      <p>{{ $student->name }}</p>
  @empty
      <p>null</p>
  @endforelse
  ```
#### 四、模型
路径: 在app/目录下.

* 1、新建模型(app/Member.php)
```
<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Member extends Model {
    public static function getMember() {
      return 'get member';
    }
}
```
* 2、路由中.
  Route::get('member', 'MemberController@member');
* 3、控制器中
  * a、use  App\Member;
  * b、return  Member::getMember();

## 《三》、laravel基础(二) ———— 数据库操作
* 1、laravel三种数据库方式—— —— DB facade(原始查找)、查询构造器、Eloquent ORM.
* 2、查看database/database.php 和 .env 文件

#### 一、数据库操作之 —— DB facade
* 1、新建数据表与连接数据库.
  * a、打开服务器首页后, `MySQL can be administered with` [phpMyAdmin](phpMyAdmin).
```
// sql语句创建student数据表
CREATE TABLE IF NOT EXISTS student(
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `age` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄',
  `sex` TINYINT UNSIGNED NOT NULL DEFAULT 10 COMMENT '性别',
  `created_at` INT NOT NULL DEFAULT 0 COMMENT '新增时间',
  `updated_at` INT NOT NULL DEFAULT 0 COMMENT '修改时间'
)ENGINE=INNODB DEFAULT CHARSET = UTF8 AUTO_INCREMENT=1001 COMMENT='学生表';
```
  * b、database.php中默认mysql, mysql配置是`env('DB_HOST'...`, 修改`.env`文件如下
  ```
  DB_HOST=localhost
  DB_DATABASE=laravel
  DB_USERNAME=root
  DB_PASSWORD=root
  ```
* 2、使用DB facade实现CURD
  **查看StudentController控制器中(一、DB facade)**

#### 二、数据库操作之 —— 查询构造器
* 1、使用PDO参数绑定, 以保护应用程序免于SQL注入,即传入的参数不需要额外转义特殊字符
  **查看StudentController控制器(二、查询构造器)**

#### 三、数据库操作之 —— Eloquent ORM
* 1、简介、模型的建立及查询数据.
  * a、Eloquent 是 Laravel 内置的 ORM 系统，我们的 Model 类将继承自 Eloquent 提供的 Model 类，然后，就天生具备了数十个异常强大的函数，从此想干啥事儿都是一行代码就搞定.
  * b、模型的建立
  ```
  <?php
  namespace App;
  use Illuminate\Database\Eloquent\Model; \\ 继承该model
  class Student extends Model {
    // 指定表名
    protected $table = 'student';
    // 指定主键, 默认主键是id
    protected $primaryKey = 'id';
    // 关闭时间戳,
    public $timestamps = false;
  }
  ```
  * c、Eloquent ORM中查询:(见StudentController.php的orm方法)
    * all()、find()、findOrFail()
    * 查询构造器在ORM中的使用
* 2、新增数据、自定义时间戳及批量赋值的使用
```
// 指定允许批量赋值的字段; => 用于模型的create添加数据
protected $fillable = ['name', 'age'];
// 指定不允许批量赋值的字段
protected $guarded = ['xxx'];
```
* 3、修改数据
```
public function orm3() {
  // 通过模型更新数据
  // $student = Student::find(1015);
  // $student->name = 'kitty';
  // $bool = $student->save();
  $num = Student::where('id', '>', '1018')->update(
    ['age' => 33]
  );
}
```
* 4、删除数据
  * a、通过模型删除`Student::find(1019)->delete();`
  * b、通过主键删除`Student::destroy(1018);`
  * c、根据指定条件删除`Student::where('id', '>', 1012)->delete();`
## 《四》、laravel基础(三) ———— blade模板引擎
* 1、简介
* 2、模板继承
  * a、section
  填充对应上yield创建出来的比如content区域
  ```
  @section('content')
    <h1>About me</h1>
  @stop
  ```
  * b、yield
    创建一个区域; @yield('content')
  * c、extends
  ```
  // 继承视图
  @extends('sites.head')
  ```
  * d、parent
* 3、模板中url
  * a、
  * b、
## 《五》、laravel基础(四) ———— 使用 Artisan 工具
新建 Model 类及其附属的 Migration 和 Seeder（数据填充）类。
* 1、`php artisan make:controller ArticleController`生成控制器
* 2、`php artisan make:model Article `在app/目录下生成Article的Model类

* 3、migration
  * a、生成 Migration
    `php artisan make:migration create_articles_table --create='articles'`
  在database/migrations下生成xx_xxx_create_article_table.php,其中有表articles
  * b、把 PHP 代码转成真是的MySQL数据表, 运行命令：`php artisan migrate`

  * c、在原来数据库增加一列
    * 11、`php artisan make:migration add_intro_column_to_articles --table=articles`
    * 22、在AddIntroColumnToArticles中的up增加新字段
      ```
      public function up() {
          Schema::table('articles', function (Blueprint $table) {
              $table->string('intro');
          });
      }
      ```
    * 33、执行`php artisan migrate`后可以看到表articles增加了intro列
