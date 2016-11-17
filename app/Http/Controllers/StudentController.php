<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use App\Http\Requests;
use Mail;
use app\Jobs\SendEmail;

class StudentController extends Controller
{
    //
    public function upload(Request $request) {
        if ($request->isMethod('POST')) {
            // var_dump($_FILES);
            $file = $request->file('source');

            // 文件是否上传成功
            if ($file->isValid()) {
                // 原文件名
                $originalName = $file->getClientOriginalName();
                // 扩展名
                $ext = $file->getClientOriginalExtension();
                // MimeType
                $type = $file->getClientMimeType();
                // 临时绝对路径
                $realPath = $file->getRealPath();

                $fileName = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;

                $bool = Storage::disk('uploads')->put($fileName, file_get_contents($realPath));
                var_dump($bool);
            }
            dd($file);
            exit;
        }
        return view('student.upload');
    }

    public function mail() {
        // 1、发送纯文本
        // Mail::raw('邮件内容', function($message) {
        //     $message->from('1xxx88@163.com', 'tso');
        //     $message->subject('邮件主题');
        //     $message->to('7xxx88@qq.com');
        //
        // });

        // 2、发送html
        Mail::send('student.mail', ['name' => 'tso'], function($message) {

            $message->to('7xxx88@qq.com');
        });
    }

    public function cache1() {
        // 1、put。第三个参数为有效期，分钟为单位
        Cache::put('key1', 'val1', 10);

        // 2、add。key不存在才会保存数据后并返回true
        $bool = Cache::add('key1', 'val1', 10);

        // 3、forever永久保存
        Cache::forever('key3', 'val3', 10);

        // 4、has判断key值是否存在
        Cache::has('key1');

    }
    public function cache2() {
        // 1、get从缓存中获取
        $val = Cache::get('key1');
        var_dump($val);

        // 2、pull取出缓存并删除该缓存
        Cache::pull('key2');

        // 3、forget删除缓存，成功返回true
        Cache::forget('key3');
    }

    // 错误
    public function error() {
        // $student = DB::table('student'); // 10001
        $student = null;
        if ($student == null) {
            abort(503); // 对应视图views/errors/503.blade.php
        }
    }

    public function log() {
        Log::info('这是一个info级别的日志');
    }

    // 队列
    public function queue() {
        dispatch(new SendEmail('27xx88@qq.com'));
    }

}
