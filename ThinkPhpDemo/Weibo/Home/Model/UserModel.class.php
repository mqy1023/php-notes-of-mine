<?php

//声明; 后面使用时引入: use Home\Model\UserModel
namespace Home\Model; 
use Think\Model;

class UserModel extends CommonModel {
	
	public function getInfo() {
		echo 'hello model world';
	}
}