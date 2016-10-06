<?php
return array(
	//'配置项'=>'配置值'

	'URL_HTML_SUFFIX' => 'html|shtml|xml',  // URL伪静态后缀设置
	
	// 连接数据库配置
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'thinkphp', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '123456', // 密码
	'DB_PORT'   => '3306', // 端口
	'DB_PREFIX' => 'think_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_RW_SEPAPATE'=>true, // 开启主从数据库服务器配置
	'DB_MASTER_NUM'=>'2', // 开启多个主数据库服务器，此为2个主数据库服务器。
	
// 	'DB_DSN'=>'mysql:host=localhost;dbname=thinkphp;charset=UTF8',
);
