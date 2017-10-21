<?php
/**
 * UserController.php
 * Created by day11.
 * User: 苏小林
 * Date: 2016/5/29
 * Time: 14:52
 */

namespace app\controller\backend;


use app\model\UserModel;

class UserController extends \core\Controller
{
    public function add()
    {
        $userModel = UserModel::create();
        if (!empty($_POST)) {
            $data = array(
                'username' => $_POST['Username'],
                'nickname' => $_POST['Nickname'],
                'email' => $_POST['Email'],
                'created_at' => time(),
            );
            if ($userModel->add($data)) {
                // 插入成功
                $this->redirect('index.php?p=backend&c=User&a=getList', '插入成功。');
            } else {
                // 插入失败
                $this->redirect('index.php?p=backend&c=User&a=add', '插入失败');
            }
        } else {
            $this->loadHtml('useradd');
        }
    }

    public function getList()
    {
        $userModel = UserModel::create();
        $users = $userModel->findAll();

        $data = array(
            'users' => $users,
        );
        $this->loadHtml('userlist', $data);
    }

    public function delete()
    {
        // 告诉我们应该删除那行记录了
        $id = $_GET['id'];
        $userModel = UserModel::create();

        // 将sql语句发送到mysql服务器里执行
        if ($userModel->deleteById($id)) {
            $this->redirect('index.php?p=backend&c=User&a=getList', '删除成功');
        } else {
            $this->redirect('index.php?p=backend&c=User&a=getList', '删除失败');
        }
    }

    public function update()
    {
        // 获取当前需要修改的用户，在html里回显出用户信息
        $id = $_GET['id'];

        $userModel = UserModel::create();

        var_dump($_POST);
        if (!empty($_POST)) {
            $data = array(
                'username' => $_POST['Username'],
                'nickname' => $_POST['Nickname'],
                'email' => $_POST['Email'],
            );
            if ($userModel->updateById($id, $data)) {
                $this->redirect('index.php?p=backend&c=User&a=getList', '修改成功');
            } else {
                $this->redirect('index.php?p=backend&c=User&a=update&id=' . $id, '修改失败');
            }
        } else {
            $user = $userModel->findOneById($id);

            $this->loadHtml('useredit', array(
                'user' => $user,
            ));
        }
    }

    public function login()
    {
        if ($_POST) {
            // 去数据库里验证用户名和密码是否存在
            $userModel = UserModel::create();
            $user = $userModel->findOneBy("password='{$_POST['password']}' AND username='{$_POST['username']}'");
            // 通过用户提交的用户名和密码，找到了用户，登录成功了？
            if (!empty($user)) {
                // 用户登录成功
                $_SESSION['loginFlag'] = true;
                $this->redirect('index.php?p=backend&c=Index&a=index', '登录成功。');
            } else {
                // 用户登录失败
                $_SESSION['loginFlag'] = false;
                $this->redirect('index.php?p=backend&c=User&a=login', '登陆失败');
            }
        } else {
            $this->loadHtml('login');
        }
    }
}