<?php
/**
 * CategoryController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/5/31
 * Time: 15:07
 */

namespace app\controller\backend;


use app\model\CategoryModel;
use core\Controller;

class CategoryController extends Controller
{
    public function add()
    {
        //if (用户提交了表单) {
        if ($_POST) {
            // var_dump($_POST);die;
            // 将分类数据插入数据库
            $data = array(
                'name' => $_POST['Name'],
                'nickname' => $_POST['Alias'],
                'sort' => $_POST['Order'],
                'parent_id' => $_POST['ParentID'],
            );
            if (CategoryModel::create()->add($data)) {
                // 创建成功， 跳转到分类的列表页getList?
                $this->redirect('index.php?p=backend&a=getList&c=Category', '创建成功');
            } else {
                // 创建失败，跳转到分类的添加页add?
                $this->redirect('index.php?p=backend&a=add&c=Category', '创建失败');
            }
        } else {
            // 显示添加表单
            $categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findAll());
            //var_dump($categorys);die;
            $this->loadHtml('category/add', array(
                'categorys' => $categorys,
            ));
        }
    }

    public function getList()
    {
        // 查询出所有的分类
        $categorys = CategoryModel::create()->limitlessLevelCategory(CategoryModel::create()->findAll());
        // 在html里显示
        $this->loadHtml('category/getList', array(
            'categorys' => $categorys,
        ));
    }

    public function update()
    {

    }

    public function delete()
    {
        $id = $_GET['id'];
        if (CategoryModel::create()->deleteById($id)) {
            $this->redirect('index.php?p=backend&c=Category&a=getList', '删除成功。');
        } else {
            $this->redirect('index.php?p=backend&c=Category&a=getList', '删除失败。');
        }
    }
}