<?php 
/*

Created By day11 
User 袁茹
Date 2017/9/30
Time 11:21
 */

namespace app\controller\backend;

class IndexController extends \core\Controller
{
	
	

	public function index()
	{
		$this->denyAccess();
		$this->loadHtml('index/index');//没有显示，就直接打印，观察问题在哪，从最近找原因
	}

	public function header()
	{
		$this->denyAccess();
       	$this->loadHtml('index/header');
	}
	public function menu()
	{
		$this->denyAccess();
		$this->loadHtml('index/menu');
	}
	public function content()
	{
		$this->denyAccess();
		$this->loadHtml('index/content');
	}
}