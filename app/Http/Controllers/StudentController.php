<?php
namespace App\Http\Controllers; // 命名空间

use Illuminate\Support\Facades\DB;

use App\Student;

// DB facade(原始查找)、查询构造器、Eloquent PRM
class StudentController extends Controller {

  // 一、DB facade
  // public function query() { // 1、查询数据库
  //   $students = DB::select('select * from student');
  //   // var_dump($students);
  //   dd($students);
  // }
  // public function query1() { // 1、查询数据库
  //   $students = DB::select('select * from student where id > ?', [1004]);
  //   dd($students);
  // }
  // public function insert() { // 2、插入数据库
  //   $bool = DB::select('insert into student(name, age) values(?, ?)', ['imooc', 19]);
  //   var_dump($bool);
  // }
  // public function update() { // 3、更新数据库
  //   $num = DB::update('update student set age = ? where name = ?', [21, 'imooc']);
  //   var_dump($num);// 返回$num是修改的行数
  // }
  // public function delete() { // 4、删除数据库
  //   $num = DB::delete('delete from student where id < ?', [1001]);
  //   var_dump($num);// 返回$num是删除的行数
  // }

  // 二、查询构造器
  public function insert() { // 1、使用查询构造器插入数据
    // 1、纯插入
    // $bool = DB::table('student')->insert(['name' => 'imooc', 'age' => 18]);
    // var_dump($bool);

    // 2、插入后返回某个属性值
    // $id = DB::table('student')->insertGetId(['name' => 'sean', 'age' => 18]);
    // var_dump($id);

    // 3、插入多条数值
    $bool = DB::table('student')->insert( [
      ['name' => 'name1', 'age' => 18],
      ['name' => 'name2', 'age' => 18]
    ]);
    var_dump($bool);
  }
  public function update() { // 2、使用查询构造器更新数据
    // $num = DB::table('student')
    //         ->where('id', 1007)
    //         ->update(['age' => 30]);
    // var_dump($num);

    // $num = DB::table('student')
    //         ->where('id', 1007)
    //         ->increment('age', 3); // decrement
    // var_dump($num);

    // 增3并修改另外的属性值
    $num = DB::table('student')
            ->where('id', 1007)
            ->increment('age', 3, ['name' => 'iimooc']);
    var_dump($num);
  }

  public function delete() { // 3、使用查询构造器删除数据
    $num = DB::table('student')
            ->where('id', 1007)
            ->delete();
    var_dump($num);

    $num = DB::table('student')
            ->where('id', '<=', 1007)
            ->delete();
    var_dump($num);

    // 删除整个数据表数据
    DB::table('student')->truncate();
  }

  public function query() { // 4、使用查询构造器查询数据
    // $students = DB::table('student')->get(); // 获取所有数据
    // dd($students);

    // $student = DB::table('student')->first(); // 获取第一条数据

    // $student = DB::table('student')
    //             ->orderBy('id', 'desc')
    //             ->first();
    //
    // $student = DB::table('student')
    //             ->where('id', '>=', 1008)
    //             ->get();

    // $student = DB::table('student')
    //             ->whereRaw('id >= ? and age > ?', [1008, 17])
    //             ->get();

    // pluck 返回查询到的数据条中某个字段
    // $name = DB::table('student')
    //             ->whereRaw('id >= ? and age > ?', [1008, 17])
    //             ->pluck('name');

    // lists 返回查询到的数据条中某个字段并可以指定key下标
    // $name = DB::table('student')
    //             ->whereRaw('id >= ? and age > ?', [1008, 17])
    //             ->lists('name', 'id');

    // select 返回查询到的数据条指定部分字段
    // $names = DB::table('student')
    //             ->select('id', 'age', 'name')
    //             ->get();

    // chuck 每次返回指定条数据
    echo '<pre>';
    DB::table('student')
        ->chunk(2, function($students) { // 每次返回2条
          var_dump($students);
          // if(xxx) {
          //   return false; // 停止返回
          // }
        });
    // dd($names);
  }

  // 查询构造器中的聚合函数: count()、max()、min()、avg()、sum()
  public function others() {
    // $count = DB::table('student')->count();
    // $max = DB::table('student')->max('age');
    $svg = DB::table('student')->avg('age');
    $sum = DB::table('student')->sum('age');
    var_dump($sum);
  }

  // 三、Eloquent ORM
  public function orm1() {
    // 1、查询
    // all(), get(), find(), findOrFail()查询不到抛异常
    // $students = Student::all();
    // $student = Student::find(1008); // 查不到的话返回null
    // $student = Student::findOrFail(1000);

    // $students = Student::get();
    // $student = Student::where('id', '>=', 1009)
    //     ->orderBy('age', 'desc')
    //     ->first();
    // dd($student);

    // echo '<pre>';
    // Student::chunk(2, function($students) {
    //   var_dump($students);
    // });

    // 聚合函数; count、max、min、
    // $num = Student::count();
    $max = Student::where('id', '>', 1001)->max('age');
    var_dump($max);
  }

  public function orm2() {
    // 使用模型新增数据
    // $student = new Student();
    // $student->name = 'bean';
    // $student->age = 21;
    // $bool = $student->save();
    // dd($bool);
    // $student = Student::find(1016);
    // echo $student->created_at;

    // $student = Student::find(1016);
    // echo date('Y-m-d H:i:s', $student->created_at);

    // 使用模型的create方法新增数据
    $student = Student::create(
      ['name' => 'imocc', 'age' => 23]
    );
    dd($student);

    // 有则返回第一条, 否则新增
    $student = Student::firstOrCreate(
      ['name' => 'imocc']
    );
  }

  public function orm3() {
    // 通过模型更新数据
    // $student = Student::find(1015);
    // $student->name = 'kitty';
    // $bool = $student->save();
    // var_dump($bool);

    $num = Student::where('id', '>', '1018')->update(
      ['age' => 33]
    );
    var_dump($num);
  }

  public function orm4() { // 删除数据
    // 通过模型删除数据
    // $bool = Student::find(1019)->delete();
    // var_dump($bool);

    // 通过主键删除
    // $num = Student::destroy(1018);
    // 通过主键删除多条数据
    // $num = Student::destroy(1016, 1017);
    // $num = Student::destroy([1014, 1015]);
    // var_dump($num);

    // 删除指定条件的数据
    $num = Student::where('id', '>', 1012)->delete();
  }

}
