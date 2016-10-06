<?php

namespace Home\Controller;

use Think\Controller;
use Think\Model;
use Home\Model\UserModel; // 导入UserModel
use Home\Model\CommonModel; // 导入CommonModel

class UserController extends Controller {
	public function index() {
		echo 'User Index Page';
	}
	// 配置URL伪静态;http://localhost:3333/codes/ThinkPhpDemo/Home/user/test/id/4.shtml
	public function test() {
		echo 'user test' . '</br>';
		echo 'id is:' . $_GET ['id'] . '</br>';
	}
	public function model() {
// 		// 1、实例化基础模型Model
// 		$user = M('user'); //表名, 表前缀, 数据库连接信息
// 		$data = $user->select ();
// 		dump ( $data );
		
		// 2、实例化用户自定义模型
// 		$user = new UserModel(); // 一定要有think_user数据表
// 		$user = D('User'); // D方法找不到自定义模型自动转换为M方法
// 		$data = $user->select ();
// 		dump ( $data );
// 		$user->getInfo();
		
		// 3、实例化公共模型
// 		$cmm = new CommonModel(); // 一定要有think_common数据表
// 		echo $cmm->strMake('aavaa');
		
		$cmm = new UserModel();
		echo $cmm->strMake('aavaa');
		
		// 4、实例化空模型
		$model = M();
		
		$data = $model->query('select * from think_user'); // 读取数据 select
		dump($data);
		
		// 写入数据 update,insert,delete
		$model->execute('update think_user set email="1@qq.com" where id=2');
	}
}