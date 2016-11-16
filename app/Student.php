<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    const SEX_UN = 10; // 未知
    const SEX_BOY = 20; // 男
    const SEX_GIRL = 30; // 女

    // 指定表名
    protected $table = 'student';

    // 支持批量赋值的字段
    protected $fillable = ['name', 'age', 'sex'];

    // 时间戳
    public $timestamps = true;

    // 插入unix时间戳
    protected function getDataFormat() {
        return time();
    }
    protected function asDateTime($val) {
        return $val;
    }

    public function sexMatch($index = null) { // 匹配选项的值
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女'
        ];
        if ($index !== null) {
            return array_key_exists($index, $arr) ? $arr[$index] : $arr[self::SEX_UN];
        }
        return $arr;
    }

}
