# Laravel高级篇

## 《一》、Artisan使用

* 1、Artisan使用帮助
    * 查看所有可用的Artisan的命令 `php artisan list`
    * 查看命令的帮助信息 `php artisan help xxx`

* 2、Artisan基本使用
    * 创建控制器`php artisan make:controller StudentController`
    * 创建模型`php artisan make:model Student`
    * 创建中间件`php artisan make:middleware Activity`

##  《二》、Laravel中的用户认证（Auth）

#### 一、Laravel中生成Auth所需文件

生成命令：`php artisan make:auth`

```
u_computer$ php artisan make:auth
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/auth/login.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/auth/register.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/auth/passwords/email.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/auth/passwords/reset.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/auth/emails/password.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/layouts/app.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/home.blade.php
Created View: /Users/xxx/mamp/SeniorLaravel/resources/views/welcome.blade.php
Installed HomeController.
Updated Routes File.
Authentication scaffolding generated successfully!
```
routes.php文件中还多出了
```
// auth验证的路由方法
Route::auth(); // 指定路由在/vendor/laravel/framework/src/illuminate/Routing/Router.php中的auth方法
Route::get('/home', 'HomeController@index');
```

#### 二、Laravel中的数据迁移
* 一、将./database/migration目录下的文件转成mysql的数据表.

迁移命令: `php artisan migrate`.后mysql数据库中增加了`migrations`,`password_resets`, `users` 三张表.

【注意】可能出现 [No such file or directory的解决方法](http://blog.csdn.net/mqy1023/article/details/53207248)

* 二、新建一个数据表的迁移文件两种方式
    * 1、新建一个students表的迁移文件
    命令：`php artisan make:migration create_students_table --create='students`
    在database/migrations下生成xx_xxx_create_students_table.php,其中--create是创建表students
    * 2、生成模型的同时生成迁移文件: `php artisan make:model Article -m`
    同样在database/migrations下生成xx_xxx_create_articles_table.php

* 三、修改未迁移的迁移文件来增加数据表中数据
```
public function up(){
    Schema::create('students', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('age')->unsigned()->default(0);
        $table->integer('sex')->unsigned()->default(10);
        $table->integer('created_at')->default(0);
        $table->integer('updated_at')->default(0);
    });
}
```
执行`php artisan migrate`后可以看到表articles数据

* 四、在原数据库中上增加一列
    * 1、先是生成补丁迁移文件：`php artisan make:migration add_intro_column_to_articles --table=articles`
    * 2、在AddIntroColumnToArticles中的up增加新字段  
    ```
    public function up() {
        Schema::table('articles', function (Blueprint $table){              $table->string('intro');
        });
    }
    ```
    * 3、执行php artisan migrate后可以看到表articles增加了intro列

#### 三、Laravel中的数据填充

* 1、创建一个填充文件，并完善填充文件
```
php artisan make:seeder StudentTableSeeder
```

然后在./database/seeds下的`StudentTableSeeder`类中增加
```
public function run(){
    DB::table('students')->insert([
        ['name' => 'sean', 'age' => 18],
        ['name' => 'immooc', 'age' => 20],
    ]);
}
```
最后可以在数据表`students`上看到上面添加的两条数据

* 2、执行单个填充文件
```
php artisan db:seed --class=StudentTableSeeder
```

* 3、批量执行填充文件
在`DatabaseSeeder`文件中添加指定class类
```
public function run(){
    // $this->call(UsersTableSeeder::class);
    $this->call(StudentTableSeeder::class);
}
```
然后执行命令
```
php artisan db:seed
```

##  《三》、Laravel框架常用功能

#### 一、文件上传
* 1、配置文件所在路径`config/filesystem.php`,在`disks`中增加`uploads`
```
'uploads' => [
    'driver' => 'local',
    'root' => storage_path('app/uploads'),//上传成功文件在/storage/app/uploads目录下
    // 'root' => public_path('uploads'),//上传成功文件在/public/uploads目录下
],
```
* 2、参考模板`upload.blade.php`和控制器`StudentController`的`upload`方法

上传成功后可以在`storage/app/uploads`目录下看到该文件.

#### 二、邮件发送
* 1、配置文件所在路径`config/mail.php`,
```
// 设置全局发件人和邮箱地址
'from' => ['address' => '1xxx66@163.com', 'name' => 'tso'],

// 用户  --> 修改.env中配置文件
'username' => env('MAIL_USERNAME'),
```

* 2、修改`.env`配置相关
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.163.com
MAIL_PORT=465
MAIL_USERNAME=1xxx88@163.com
MAIL_PASSWORD=xxxx123
MAIL_ENCRYPTION=ssl
```

* 2、发送：
    * a、发送纯文本
    ```
    Mail::raw('邮件内容 测试', function($message) {
        $message->from('13xxx29@163.com', 'tso');
        $message->subject('邮件主题 测试');
        $message->to('2xxx94@qq.com');
    });
    ```
    * b、发送Html格式
        * 1、新建模板, 在`resource/view/student/`目录下新建`mail.blade.php`
        ```
        <h1> hello {{ $name }} </h1>
        ```
        * 2、controller中发送
        ```
        Mail::send('student.mail', ['name' => 'tso'], function($message) {
            $message->to('7xxx88@qq.com');
        });
        ```

#### 三、缓存的使用
* 1、配置文件所在路径`config/cache.php`,
```
// 源码，可知文件保存路径到/storage/framework/cache目录下
'file' => [
    'driver' => 'file',
    'path' => storage_path('framework/cache'),
],
```

#### 四、错误与日志
* 1、Debug模式
配置文件所在路径`config/app.php`, 进行本地开发是, `APP_DEBUG`为`true`，上线为`false`

* 2、HTTP异常
```
public function error() {
    // $student = DB::table('student'); // 10001
    $student = null;
    if ($student == null) {
        abort(503); // 对应视图views/errors/503.blade.php
    }
}
```

在视图`view/error`目录下增加`404.blade.php`模板, 打开不存在的路由时出现该模板内容.

* 3、日志

1、配置文件所在路径`config/app.php`, 关键字`APP_LOG`.
```
'log' => env('APP_LOG', 'single'), // 'daily'文件名和当天相关
```

2、打印日志.
```
Log::info('这是一个info级别的日志'); // error, warning
```
3、日志保存路径`storage/logs`目录下.

#### 五、队列的应用
配置文件路径`config/queue.php`, 修改为`database`驱动
* 1、作用：允许推迟好时任务的执行， 从而大幅度提高web请求速度

* 2、主要步骤
    * 1、迁移队列需要的数据表
        * a、产生需要迁移的文件：
        命令`php artisan queue:table`后可以在`database/migrations`目录下看到`xx_create_jobs_table`
        * b、执行迁移
        `php artisan migrate` 会看到数据库多出`jobs`表
    * 2、编写任务类
        * 1、创建一个发送邮件任务类命令：
        `php artisan make:job SendEmail`后可以在`app/Jobs`目录下看到`SendEmail.php`
        * 2、修改SendEmail, 查看该类的`handle`方法
    * 3、推送任务到队列
    ```
    dispatch(new SendEmail('27xx88@qq.com'));
    ```
    * 4、运行队列监听器
    `php artisan queue:listen`
    * 5、处理失败任务
        * 1、建立队列任务失败表：`php artisan queue:failed-table`
        * 2、迁移到数据库：`php artisan migrate`

        * 3、查看错误队列：`php artisan queue:failed`
        * 4、重新运行某个任务,比如ID为1(all为执行所有)任务，`php artisan queue:retry 1`
        * 5、删除某个失败任务, `php artisan queue:forget 1`
        * 6、删除所有失败任务呀, `php artisan queue:flush`
