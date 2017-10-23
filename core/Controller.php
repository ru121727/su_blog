<?php

namespace core;

use vendor\Smarty;

// 核心控制器
class Controller
{
    protected $s;

    protected function initSmarty()
    {
        $s = new Smarty();

        // smarty不认识< >怎么让它认识？
        // 1. 设置smarty左定界符
        $s->left_delimiter = '<{';
        // 2. 设置smarty右定界符
        $s->right_delimiter = '}>';

        // templates 目录改为 view 目录之后，Smarty找不到templates目录了怎么？
        // 将Smarty默认的模版目录从templates目录修改为view
        $s->setTemplateDir(VIEW_PATH);
        // 自定义编译文件目录,将文件放到系统的临时目录里
        // sys_get_temp_dir();
        $s->setCompileDir(sys_get_temp_dir() . DS . 'view_c');
        // 自定义缓存文件目录,将缓存文件放到系统的临时目录里
        $s->setCacheDir(sys_get_temp_dir() . DS . 'cache');
        // 自定义配置文件目录
        $s->setConfigDir(CONFIG_PATH);

        $this->s = $s;
    }

    public function __construct()
    {
        $this->initSmarty();
    }


    public function redirect($url, $msg = '', $waitSeconds = 3)
    {
        echo $msg;
        header('Refresh: ' . $waitSeconds . '; url=' . $url);
    }
    
   protected function loadHtml($name, $data = array())
    {
        /*$data = array(
            'users' => $users,
            'a' => '1',
           'b' => '2',
           'c' => '3',
        );*/
        foreach($data as $variableName => $variableValue) {
            $$variableName = $variableValue;
        }
        require VIEW_PATH . DS . PLATFORM . DS . $name . '.html';
    }

    //控制是否登录的访问权限
    protected function denyAccess()
	{
		if(isset($_SESSION['loginFlag']) && $_SESSION['loginFlag'] == true) {

		} else {
			//验证通过
			$this->redirect('index.php?p=backend&c=User&a=login', '请登录');
			exit(0);
		}
   }
}





















