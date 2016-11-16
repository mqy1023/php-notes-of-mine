<?php
namespace App\Http\Controllers; // 命名空间
use App\Student;
use Illuminate\Http\Request; // Request导入

// Form表单控制器
class StudentsController extends Controller {

    public function index() {
        // $students = Student::get(); // 取出所有数据
        $students = Student::paginate(10); // 分页，每页4条

        // dd($students);
        // 对应resources/views/student/index.blade.php
        return view('student.index', [
            'students' => $students,
        ]);
    }

    // 添加页面
    public function create(Request $request) {
        $student = new Student();
        // 1、form中`action="{{ url('student/save') }}"`指定保存添加到此save方法
        // return view('student.create');

        // 2、form中`action=""`在当前方法保存
        if ($request->isMethod('POST')) {

            // 1、控制器验证
            // $this->Validate($request, [
            //     'Student.name' => 'required|min:2|max:20',
            //     'Student.age' => 'required|integer',
            //     'Student.sex' => 'required|integer'
            //
            // ], [
            //     'required' => ':attribute 为必填项!',
            //     'min' => ':attribute 最小长度不符合要求!',
            //     'integer' => ':attribute 必须为整数!',
            // ], [
            //     'Student.name' => '姓名',
            //     'Student.age' => '年龄',
            //     'Student.sex' => '性别',
            // ]);

            // 2、Validator验证
            $validator = \Validator::make($request->input(), [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer'

            ], [
                'required' => ':attribute 为必填项!',
                'min' => ':attribute 最小长度不符合要求!',
                'integer' => ':attribute 必须为整数!',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('Student');
            // 需在Student.php的Model中设置'$fillable'来支持批量赋值的字段
            if(Student::create($data)) {
                return redirect('student/index')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }
        return view('student.create', [
            'student' => $student
        ]);
    }

    // 指定保存添加到此save方法
    public function save(Request $request) {
        $data = $request->input('Student');
        // var_dump($data);
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];
        if ($student->save()) {
            return redirect('student/index');
        } else {
            return redirect()->back();
        }
        // return view('student.create');
    }

    // 更新
    public function update(Request $request, $id) {
        $student = Student::find($id);

        if ($request->isMethod('POST')) {

            // 1、控制器验证
            $this->Validate($request, [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer'

            ], [
                'required' => ':attribute 为必填项!',
                'min' => ':attribute 最小长度不符合要求!',
                'integer' => ':attribute 必须为整数!',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];
            if ($student->save()) {
                return redirect('student/index')->with('success', '修改成功- '.$id);
            } else {
                return redirect()->back();
            }
        }


        return view('student.update', [
            'student' =>  $student
        ]);
    }

    // 查看详情
    public function detail($id) {

        $student = Student::find($id);

        return view('student.detail', [
            'student' =>  $student
        ]);
    }

    // 删除
    public function delete($id) {

        $student = Student::find($id);
        if($student->delete()) {
            return redirect('student/index')->with('success', '删除成功- '.$id);
        } else {
            return redirect('student/index')->with('success', '删除失败- '.$id);
        }
    }
}
