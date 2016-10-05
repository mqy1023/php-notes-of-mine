<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class UserController extends Controller {
    public function index(){
    	echo 'User Index Page';
    }
    public function model() {
    	// 创建Model基类，传递User表，think_user
    	$user = new Model('User');
//     	var_dump($user);
    	var_dump($user->select());
    }
    // http://localhost:3333/codes/ThinkPhpDemo/Home/user/test/id/4.shtml
    public function test() {
    	echo 'user test'.'</br>';
    	echo 'id is:'.$_GET['id'].'</br>';
    }
}