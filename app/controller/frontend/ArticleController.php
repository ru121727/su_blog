<?php 
namespace app\controller\frontend;
use core\Controller;
use app\model\ArticleModel;
use app\model\CategoryModel;
use app\model\CommentModel;

class ArticleController extends Controller
{
	public function getList()
	{
		//拿取数据
		$articles = ArticleModel::create()->getAllWithJoin();
		$categories = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findAll());
		//$this->s->assign('article', $articles);
		$this->s->assign(array('article'=>$articles, 'categories'=>$categories));

		$this->display('frontend/article/getList.html');
	}

	public function detail()
	{//var_dump(ArticleModel::create()->findAll());die;
		$id = $_GET['article_id'];
		$article = ArticleModel::create()->getOneWithJoin($id);
		//给文章id的阅读书增加一
		ArticleModel::create()->increaseReadNumber($id);
		//将文章的所有评论查找出来
		$comments = CommentModel::create()->limitlessLevel(CommentModel::create()->getAllWithJoinUserByArticleId($id));
		foreach($comments as $comment) {

		}
		//var_dump($comments);die;
		$this->s->assign(array(
			'article'=>$article,
			'comments'=>$comments
			));
		$this->s->display('frontend/article/detail.html');

	}

	public function praise()
	{
		$id = $_GET['id'];
		if(issset($_SESSION["praise_id"]) || $_SESSION['praise_id'] != true) {
			ArticleModel::create()->increatePraiseNumber($id);
			$_SESSION['praise_id'] = true;
			$this->redirect('index.php?p=frontend&c=Article&a=detail&id={$id}', '点赞成功');
		} else {
			$this->redirect('index.php?p=frontend&c=Article&a=detail&id={$id}', '不能重复点赞');
		}
		

		
	}
}