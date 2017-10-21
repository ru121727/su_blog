<?php 
namespace app\controller\backend;

use \core\Controller;
use \app\model\CategoryModel;

class CategoryController extends Controller
{
	public function  add()
	{
		$this->denyAccess();
     //添加表单会  不添加会
     if($_POST) {
       //var_dump($_POST);die;
       //接收数据 进行组装提交插入
       $data = array(
       		'name' => $_POST['Name'],
       		'nickname'=> $_POST['Alias'],
       		'sort'    => $_POST['Order'],
       		'parent_id'=>$_POST['ParentID']
       	);
       if(CategoryModel::create()->add($data)) {
       		//创建成功
       		$this->redirect('index.php?p=backend&c=Category&a=getList', '添加成功');
       } else {
       		$this->redirect('index.php?p=backend&c=Category&a=add', '添加失败');
       }
       
     } else {
     	$categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findALL());
     	$this->loadHtml('category/add', array('categorys' => $categorys));
     }
	}

	public function getList()
	{
		$this->denyAccess();
		$categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->getAllWithJoin());
		var_dump($categorys);die;

		$this->loadHtml('category/getList', array('categorys'=>$categorys));
	}

	public function update()
	{
		$this->denyAccess();
		$id = $_GET['id'];

		if($_POST) {
			/*if(修改成功) {
			//跳转到列表页
			//
			} else {
				//修改失败 跳转到  修改页
			}*/

			$data = array(
               'sort' => $_POST['Order'],
               'name' => $_POST['Name'],
               'nickname' => $_POST['Alias'],
               'parent_id'=> $_POST['ParentID']
				);
			if(CategoryModel::create()->updateById($id, $data)) {
				$this->redirect('index.php?p=backend&c=Category&a=getList', '修改成功');
			} else {

				$this->redirect('index.php?p=backend&c=Category&a=update&id='.$id, '修改失败');
			}
		} else {

			$categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findALL('2>1', 'sort DESC'));
			$category = CategoryModel::create()->findOneById($id);
			//var_dump($category);
			$this->loadHtml('category/update', array(
  					'category' => $category,
  					'categorys'=> $categorys
				));
		}
	}

	public function delete()
	{
		$this->denyAccess();
		$id = $_GET['id'];

		if(CategoryModel::create()->count("parent_id = '{$id}'") > 0) {
			$this->redirect('index.php?p=backend&a=category&c=getList', '禁止删除');
			exit(0);
		}

		if(CategoryModel::create()->delete()) {
			$this->redirect('index.php?p=backend&c=Category&a=getList', '删除成功');
		} else {
			$this->redirect('index.php?p=backend&c=Category&a=getList', '删除失败');
		}
	}
}