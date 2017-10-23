<?php 
namespace app\controller\frontend;

use core\Controller;

class CommentController extends Controller
{
	public function add()
	{
		$this->denyAccess();
		$user_id = $_SESSION['user']['id'];
		$articleId = $_GET['article_id'];
		$parentId = $_POST['inpRevID'];
		$content = $_POST['txaArticle'];
		$publishTime = time();
		if(CommentModel::create()->add(array(
			'user_id' => $user_id,
			'article_id' => $article_id,
			'parent_id' => $parent_id,
			'cotent'   => $content,
			'publish_time'=> $publishTime
			))
		) {
			$this->redirect('index.php?p=frontend&c=Article&a=detail&id={$id}', '评论成功');
		} else {
			$this->redirect('index.php?p=frontend&c=Article&a=detail&id={$id}', '评论成功');
		}
		//var_dump($articleId, $_POST);die;
	}
}