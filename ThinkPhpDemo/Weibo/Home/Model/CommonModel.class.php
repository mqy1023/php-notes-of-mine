<?php

//声明; 后面使用时引入: use Home\Model\CommonModel
namespace Home\Model;

use Think\Model;

class CommonModel extends Model {
	
	public function strMake($str) {
		return md5(sha1(md5($str)));
	}
	
	/* '命名范围的标识名'=>array(
	 '属性'=>'值',
	 支持的方法有：where limit field order table page having goup distinct
	 ) */
	protected $_scope = array(		//用于数据库命名范围
		'small'=>array(
			'where'=>array(
				'id'=>array('elt',5)
			),
			'order'=>'id asc'
		),

		'big'=>array(
			'where'=>array(
				'id'=>array('egt',6)
			),
			'order'=>'id desc'
		)
	);
}