<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {
  // 指定表名
  protected $table = 'student';

  // 指定主键, 默认主键是id
  protected $primaryKey = 'id';

  // 指定允许批量赋值的字段; => 用于模型的create添加数据
  protected $fillable = ['name', 'age'];
  // 指定不允许批量赋值的字段
  protected $guarded = ['xxx'];

  // 关闭时间戳
  public $timestamps = true;

  // 插入unix时间戳
  protected function getDateFormat() {
    return time();
  }

  protected function asDateTime($val) {
    return $val;
  }
}
