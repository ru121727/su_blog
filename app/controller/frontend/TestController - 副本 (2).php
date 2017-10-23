<?php 
namespace app\controller\frontend;

use core\Controller;
use vendor\Smarty;

class TestController extends Controller
{
	
		public function test()
		{
			var_dump($this->s);die;
		}

		public function __construct()
		{
			$this->initSmarty();
		}
}