<?php 
namespace app\controller\frontend;

use core\Controller;
use vendor\Smarty;

class TestController extends Controller
{
	public function test()
	{
		$s = new Smarty();
		$s ->assign('a', 'aaaa');
		$s->display('a.html');
		
	}
}