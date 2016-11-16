<?php
namespace App\Http\Controllers; // 命名空间
use Illuminate\Http\Request; // Request导入
use Illuminate\Support\Facades\Session;

// use Session;

// Controller介绍
class StudentController extends Controller {

    public function request1(Request $request) {
        // 1、判断是否有值
        $request->has('name');
        // 2、取值 -> http://localhost:55/LaravelForm/public/request1?name=mmm
        // return $request->input('name', '默认空值');
        // 3、取所有值 -> http://localhost:55/LaravelForm/public/request1?name=mmm&aa=11
        // $res = $request->all();
        // dd($res);

        // 4、判断请求类型
        echo $request->method();
        $request->isMethod('GET'); // POST...
        $request->ajax(); // 是否是ajax请求

        // 5、判断是否是该控制器下的方法
        // 路由修改为student/xx后为true, http://localhost:55/LaravelForm/public/student/request1?name=mmm&aa=11
        $res = $request->is('student/*');
        dd($res);

        // 6、获取当前的url
        $res = $request->url();
        return res;
    }

    public function session1(Request $request) {
        // 1、HTTP request session() 存取
        // $request->session()->put('key1', 'value1');
        // dd($request->session()->get('key1'));

        // 2、session辅助方法
        // session()->put('key3', 'value');
        // dd(session()->get('key3'));

        // 3、Session
        // Session::put('key3', 'vvv'); // 存储数据到Session
        // dd(Session::get('key3', '默认显示空值'));

        // 4、Session以数组形式存取
        // Session::put(['key4' => '444']);
        // dd(Session::get('key4'));

        // 5、把数据放到Session的数组中
        // Session::push('student', '444');
        // Session::push('student', '555');
        // var_dump(Session::get('student'));

        // 6、用pull取出数据并删除该条, 之后为null
        // var_dump(Session::pull('student', '555'));

        // 7、判断key是否存在
        // Session::has('key1');

        // 8、获取Session所有值
        // Session::all();

        // 9、forget删除某个key-value键值对
        // Session::forget('key1');

        // 10、清空所有session信息
        // Session::flush();

        // 11、暂存数据,即只有第一次访问有效
        // Session::flash('key-flash', 'value-flash');
        // Session::get('key-flash');


    }
    public function session2() {
        // $res = Session::all();
        // dd($res);
        // return 'session2';
        return Session::get('msg', '暂无信息');

        echo session('msg');
        return session('msg');
    }

    public function response() {
        // 1、响应json
        // $data = [
        //     'errCode' => 0,
        //     'errMsg' => 'success',
        //     'data' => 'sean',
        // ];
        // return response()->json($data);

        // 2、重定向
        // return redirect('session2');

        // 3、重定向中传值(get第一次访问才能出现该值)
        // return redirect('session2')->with('msg', '我是快闪数据');

        // 4、重定向中间键action()
        // return redirect()->action('StudentController@session2')->with('msg', '我是快闪数据');

        // 5、重定向中间键route()
        return redirect()->route('session2')->with('msg', '我是快闪数据');

        // 6、由重定向返回上一页面
        // return redirect()->back();
    }

    // 对应活动的宣传页面
    public function activity0() {
        return '活动快要开始了, 敬请期待!';
    }
    // 对应活动的页面
    public function activity1() {
        return '活动进行中, 谢谢您的参与1!';
    }
    // 对应活动的页面
    public function activity2() {
        return '互动进行中, 谢谢您的参与2!';
    }


}
