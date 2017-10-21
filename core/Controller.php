<?php

namespace core;

// 核心控制器
class Controller
{
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





















