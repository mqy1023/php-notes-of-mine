<?php
// 一定要声明, 否则无法加载SqlCURD控制器
namespace Home\Controller;
use Think\Controller;

class SqlOthersController extends Controller {
	
	public function index() {
		echo 'SqlOthers Page';
	}
	public function sql() {
		// 1、连续操作：
		
		// a：order排序(多个条件用逗号隔开)：
// 		$data=M('user')->order('user desc,id asc')->select();
// 		dump($data);
		
		// b、filed方法(筛选字段)
// 		field($string,false); // 默认状态 查询$string,多个字段用逗号隔开
// 		field($string,true); // 查询$string以外的数据
// 		$data=M('user')->field('id,user', true)->order('id desc')->select();
// 		dump($data);
		
		// c、limit 和 page方法
// 		limit（start，length）; // 第一个参数可以省略, 默认从0开始
		// page(页码，每页的条数); 每页默认条数20
		// page(2,5)与->page(2)->limit(5)结果是一样的
		
// 		$data = M('user')->page(2)->limit(2)->select();
// 		dump($data);
		
		// d、group 和 having方法（having()配合group分组进行过滤）
		// 分组并显示每组中一样的个数
// 		$data = M('User')->field('user,count(*)as total')->group('user')->having('user="mmm"')->select();
// 		dump($data);
		
		// 2、多表查询
		
		// a、table方法
// 		table(array('前缀_表名1'=>'别名1','前缀_表名2'=>'别名2',……)); // 多表查询; 表名需要加前缀
// 		$data = M('User')->table(array('think_user'=>'user','think_common'=>'com'))
// 		->where('user.id=com.id')->select();
// 		dump($data);
		
		// b、join方法; 拼接表格, 支持字符串和数组
// 		$data = M('User')->join(array('think_common On think_user.id=think_common.id'))->select();
// 		dump($data);
		
		// c、union方法
		// union（'string/array',true/false）默认false 支持字符串和数据 union（参数二位true）不过滤重复，union过滤查询
// 		$data = M('User')->field('user')->union('select name from think_common')->select();
// 		dump($data);
		
		// d、distinct用来过滤相同信息，属性为true和falsse
		$data=M('user')->distinct(true)->field('user')->order('user asc')->select();
		dump($data);
	}
	
	public function range() { // 命名范围的使用
		$comm = D('Common');
		$data = $comm->scope('small')->select(); // 查看CommonModel
		dump($data);
		echo M()->getLastSql();
	}
}