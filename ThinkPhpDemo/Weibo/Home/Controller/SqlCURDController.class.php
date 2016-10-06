<?php
// 一定要声明, 否则无法加载SqlCURD控制器
namespace Home\Controller;
use Think\Controller;

class SqlCURDController extends Controller {
	
	public function index() {
		echo 'SqlCURD Page';
	}
	// 数据库增删查改CURD操作
	public function curd() {
		
		// 1、add增加数据
		$data = array (
				0 => array (	
						'user' => 'mmm',
						'email' => '123@qq.com',
						'data' => date ('Y-m-d H:i:s') 
				),
				1 => array (
						'user' => 'nnn',
						'email' => '233@qq.com',
						'data' => date ('Y-m-d H:i:s')
				)
		);
// 		M ( 'user' )->add ( $data ); // 一个数据
		M('user')->addAll($data); // 此处插入多条数据,addAll只适合mysql数据库
		
// 		echo M()->getLastSql(); // 获取所执行的sql语句
		
		// 2、select查询
		
		// a：直接用字符串查询：
// 		$data=M('User')->where('id=1')->select();
// 		dump($data);

		// b:使用数组方式进行查询：
// 		$where['id']=1;
// 		$where['user']='nnn';
// 		$where['_logic']='or'; // 若不写此行，就会查找同时满足上述两组条件的数据
// 		$data=M('User')->where($where)->select();
// 		dump($data);

		// c: 表达式查询('eq'=>'='、'neq'=>'!='、'egt'=>'>='、'gt'=>'>'、
		//   'elt'=>'=<'、'lt'=>'<'、between、in、not in、like、not between（not+空格+比较符）)
		//$where['字段名']=array('表达式',查询条件);
		//$where ['id']=array('lt',3);//查询<3的数据
		
// 		$where['id']=array('between','1,4');//查询id是1到8的数据
// 		$where['id']=array('lt', 3);//查询id<3的数据
		//查询user_name模糊等于%ming 模糊等于xiao的数据
// 		$where['user']=array('like',array('%mm','mno%'));
		
// 		$data=M('User')->where($where)->select();
// 		dump($data);

		// d: 区间查询
// 		$where["id"]=array(array("gt",10),array("lt",3),'or');

		// e: 混合用法,,,,尽量用表达式查询和区间查询，少用字符串查询和混合查询
// 		$where["id"]=array("gt",1);
// 		$where["_string"]="id>6"; // 添加另外的查询关键字段
// // 		$where["_logic"]="or";//条件之间的关系
// 		$data=M('User')->where($where)->select();
// 		dump($data);
		
		// f: 统计用法
		// count统计数量 可选;max/min 获取最大/最小值 必须传入 统计的字段名
		// avg 平均值 必须传入 统计的字段名; sum 求和 必须传入 统计的字段名
		$data =M('user')->avg('id');//查询语句(其中id是传入的值)
		dump($data);
		
		
		// 3、update 更新
// 		$where['id']=1;
// 		$update['user']="hello";
// 		$data=M('User')->where($where)->save($update);
		// 4、delete删除
		$where['id']=4;
		M('User')->where($where)->delete();
		
		M('User')->delete(5);//delete()只可以传入主键值
	}
}
