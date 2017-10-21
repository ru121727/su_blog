<?php
namespace app\model;

class TestModel extends \core\Model
{
	protected $table = 'user';//类中的属性一般就是从外面传参数进行赋值的
	//变量就是暂时存储值让接下来的数据进行使用的
	/*public function findALL()
	{
		$sql = 'SELECT * FROM `{$this->table}`';
		return $this->getAll($sql);
	}*/

	public function challenge()
	{
		$products = $this->updateById(28,array('username'=> 'yuan111','nickname'=>'ru'), 'id');
		
		
	}
}