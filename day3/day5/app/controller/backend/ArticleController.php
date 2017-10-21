<?php
/**
 * ArticleController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/6/1
 * Time: 14:55
 */

namespace app\controller\backend;


use app\model\ArticleModel;
use app\model\CategoryModel;

class ArticleController extends \core\Controller
{
    public function add()
    {
        $this->denyAccess();
        if ($_POST) {
            $data = array(
                'title' => $_POST['Title'],
                'content' => $_POST['Content'],
                'category_id' => $_POST['CateID'],
                'status' => $_POST['Status'],
                'published_date' => strtotime($_POST['PostTime']),
                'top' => isset($_POST['isTop']) ? $_POST['isTop'] : 2,
                'author_id' => $_SESSION['user']['id'],
            );
            if (ArticleModel::create()->add($data)) {
                $this->redirect('index.php?p=backend&c=Article&a=getList', '添加成功');
            } else {
                $this->redirect('index.php?p=backend&c=Article&a=add', '添加失败');
            }
        } else {
            $categorys = CategoryModel::create()
                            ->limitlessLevelCategory(
                                CategoryModel::create()->findAll()
                            );
            $this->loadHtml('article/add', array(
                'categorys' => $categorys,
            ));
        }
    }

    public function getList()
    {
        $where = '2 > 1';
        if ($_POST) {
            if ($_POST['category']) {
                $where .= " AND category_id = '{$_POST['category']}'";
            }
            if ($_POST['status']) {
                $where .= " AND status = '{$_POST['status']}'";
            }
            if (isset($_POST['istop'])) {
                $where .= " AND top = '{$_POST['istop']}'";
            }
            if ($_POST['search']) {
                $where .= " AND title LIKE '%{$_POST['search']}%'";
            }
        }
        $articles = ArticleModel::create()->findAll($where);
        $categories = CategoryModel::create()
                        ->limitlessLevelCategory(
                            CategoryModel::create()->findAll()
                        );
        $this->loadHtml('article/getList', array(
            'articles' => $articles,
            'categories' => $categories,
        ));
    }
}