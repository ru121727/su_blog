<?php 
namespace app\controller\backend;

use core\Controller;
use app\model\ArticleModel;
use app\model\CategoryModel;
use vendor\Pager;

class ArticleController extends Controller
{
	public function add()
	{
		if($_POST){
			//var_dump($_POST);die;
			//接收提交的数据
			$data = array(
				'title' => $_POST['Title'],
				'content' => $_POST['Content'],
				'category_id' => $_POST['CateID'],
				'status' => $_POST['Status'],
				'published_date' => strtotime($_POST['PostTime']),
				'top' => isset($_POST['isTop']) ? $_POST['isTop'] : 2
				);
			if(ArticleModel::create()->add($data)) {
				$this->redirect('article/getList', '添加成功');
			} else {
				$this->redirect('article/add', '添加失败');
			}

		} else {
			$categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findALL());
			$this->loadHtml('article/add',array('categorys' => $categorys));
		}
	}

	public function getList()
	{	//var_dump($_POST['status']);die;
		 $where = '2 > 1';//可以作为一个自己定义的变量使用，为了防止这个变量不存在
		if($_POST) {
			//var_dump($_POST);
			

		  if($_POST['category']) {
		  	//echo 1;
  				$where .= " AND category_id = {$_POST['category']} ";
			} 
			if($_POST['status']) {
				//echo 2;
				$where .= " AND status = {$_POST['status']} ";
			}
			if(isset($_POST['istop']) && $_POST['istop']) {
				//echo 3;
				$where .= " AND top = {$_POST['istop']} AND";
			}
			if($_POST['search']) {
					//echo 4;
				$where .= " AND title LIKE '%{$_POST['search']}%'";
			}
		}
		//echo $where;die;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pageSize = 1;
        $pager = new Pager(ArticleModel::create()->count(), $pageSize, $page, 'index.php', array(
            'p' => 'backend',
            'c' => 'Article',
            'a' => 'getList',
        ));
        // 获取分页按钮
        $pageButtons = $pager->showPage();

      $start = ($page - 1) * $pageSize;
	  $articles = ArticleModel::create()->getAllWithJoin($where, 'id ASC', $start, $pageSize);
	  var_dump($articles);die;
		$categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findALL());

		$this->loadHtml('article/getList', array(
			'articles'=>$articles,
			'categorys' => $categorys,
			'pageButtons' => $pageButtons
			));
	}
}