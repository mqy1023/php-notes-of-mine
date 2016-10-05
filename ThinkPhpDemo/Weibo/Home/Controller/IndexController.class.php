<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    // 1、自定义函数库
    public function showFunction() {
    	show(); // 对应Weibo/Common/function.php中的show()
    }
    // 2、系统函数 和 系统参数
    public function test() {
    	$me['name'] = 'mqy';
    	$this->assign('me', $me);
    	$this->now = time();
    	$this->display('Index/test');
    }
    // 3、volist和foreach循环
    public function volist() {
    	$person=array(
    			1=>array("name"=>"dominic1","age"=>"25"),
    			2=>array("name"=>"dominic2","age"=>"24"),
    			3=>array("name"=>"dominic3","age"=>"28"));
    	
    	$this->assign("person",$person);
    	$this->display();
    }
    // 4、for循环和if判断和三元操作符和switch判断和比较/区间标签
    public function forIf() {
    	$num = 7;
    	$name = 'teacher';
    	$val = 10;
    	$this->assign('num', $num)->assign('name', $name)->assign('val', $val);
    	$this->assign('rangeVal', 4);
    	$this->display();
    }
    
    // 5、debug调试开启; 
    // a、在./Weibo/Common/conf下创建debug.php b、配置debug的数组key和value键值对
    public function debug() {
//     	echo C('name');
//     	trace('name', C('name'));
//     	dump($_SERVER);
    	G('run'); // 记录运行时间
    	for($i=0; $i<10000; $i++) {
    		$count += $i;
    	}
    	echo G('run', 'end'); //单位为毫秒
    	$this->display();
    }
    
}