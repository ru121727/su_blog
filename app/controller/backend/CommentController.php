<?php 
namespace app\controller\backend;

use core\Controller;
use app\model\CommentModel;

class CommentController extends Controller
{
	public function getList()
	{
		$comments = CommentModel::create()->getAllWithJoin();
		//var_dump($comments);die;
		return $this->loadHtml('comment/getList', array('comments' => $comments));
	}

	public function delete()
	{
		$id = $_GET['id'];

		if(CommentModel::create()->deleteById($id)) {
			$this->redirect('index.php?p=backend&c=Comment&a=getList', '删除成功');
		} else {
			$this->redirect('index.php?p=backend&c=Comment&a=getList', '删除失败');
		}
	}
}
