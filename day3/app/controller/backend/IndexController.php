<?php

namespace app\controller\backend;

class IndexController extends \core\Controller
{
    public function index()
    {
//        if (用户登录了) {
//            正常访问
//        } else if (用户没有登录呢？) {
//            跳转到用户登录页面
//        }
        if (isset($_SESSION['loginFlag']) && ($_SESSION['loginFlag'] == true)) {
            $this->loadHtml('index');
        } else {
            $this->redirect('index.php?p=backend&c=User&a=login', '请登录。');
        }
    }

    public function header()
    {
        $this->loadHtml('header');
    }

    public function menu()
    {
        $this->loadHtml('menu');
    }

    public function content()
    {
        $this->loadHtml('content');
    }
}