<?php 
 namespace vendor;

require ROOT_PATH . DS . 'vendor'. DS . 'libs'.DS. 'Smarty.class.php';

 class Smarty extends \Smarty
 {
 	public function test()
 	{

		$s = new Smarty();

		// smarty不认识< >怎么让它认识？
		// 1. 设置smarty左定界符
		$s->left_delimiter = '<{';
		// 2. 设置smarty右定界符
		$s->right_delimiter = '}>';

		// templates 目录改为 view 目录之后，Smarty找不到templates目录了怎么？
		// 将Smarty默认的模版目录从templates目录修改为view
		$s->setTemplateDir('VIEW_PATH');
		// 自定义编译文件目录
		$s->setCompileDir(sys_get_temp_dir().DS.'view_c');
		// 自定义缓存文件目录
		$s->setCacheDir(sys_get_temp_dir().DS.'cache');
		// 自定义配置文件目录
		$s->setConfigDir('CONFIG_PAYH');

		 	}
 }