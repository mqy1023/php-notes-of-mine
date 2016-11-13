<?php
namespace App\Http\Controllers; // 命名空间

use App\Member;

class MemberController extends Controller {

    public function info() {
        return 'member-info';
    }
    public function getId($id) {
        return 'member-info-'.$id;
    }
    // 视图
    public function viewInfo() {
        return view('info');
    }
    // blade 模板
    public function viewInfos() { // member.info也可以
      return view('member/info', [
          'name' => 'china',
          'age' => 18
        ]);
    }

    public function member() {
        return Member::getMember();
    }

    public function section() {
      $name = 'haha';
      $arr = ['aaa', 'bbb', 'haha'];
      $students = [];
      return view('member.info', [
          'name' => $name,
          'arr' => $arr,
          'students' => $students
        ]
      );
    }

    public function urlTest() {
      return 'urlTest';
    }

    public function test() {
      $name = 'haha';
      return view('member.test', compact('name'));
      // $name = '<span style="color:red">jelly</span>'; // 对应非转义输出{!! $name !!}
      // return view('member.test')->with('name', $name);
    }
}
