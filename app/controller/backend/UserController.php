<?php 
namespace app\controller\backend;
use app\model\UserModel;

class UserController extends \core\Controller
{
	public function add()
	{
		$this->denyAccess();
		if(!empty($_POST)){
			$data = array(
              'username' => $_POST['Username'],
              'nickname' => $_POST['Nickname'],
              'email'    => str_replace('</script>', '', str_replace('<script>','', $_POST['Email']))
          );
         $userModel = UserModel::create();
          if ($userModel->add($data)) {
            $this->redirect('index.php?p=backend&c=User&a=getList', '插入成功');
          } else{
            $this->redirect('index.php?p=backend&c = User&a=add');
          }
		}else{
			$this->loadHtml('user/useradd');
		}
     //$userModel = Model::create('\app\model\UserModeld');
    
     //var_dump($userModel);//说明数据库已经连接成功了
	}

	public function getList()
	{
        $this->denyAccess();
		$userModel = UserModel::create();
		//var_dump($userModel);die;
		$users = $userModel->findALL();
		$a = 1;
		$b = 2;
		$data = array(
             'users' => $users,
             'a'     => 1
             );
		$this->loadHtml('user/userlist', $data);
	}

	public function delete()
	{
	  $this->denyAccess();
      $id = $_GET['id'];

      $userModel = UserModel::create();
      //var_dump($userModel);
      //将sql语句发送到mysql服务器进行执行
      if($userModel->deleteById($id)) {
      	$this->redirect('index.php?p=backend&c=User&a=getList', '删除成功');
      } else {
      	$this->redirect('index.php?p=backend&c=User&a=getList', '删除失败');
      }
      
	}

	public function update()
	{

	 $this->denyAccess();
     $id = $_GET['id'];
     $userModel = UserModel::create();
     
     /*$data = array(
            'username' => $_POST['Username'],//
            'nickname' => $_POST['Nickname'],
     	);
     die;*/

     if(!empty($_POST)) {
        $data = array(
            'username' => $_POST['Username'],
            'nickname' => $_POST['Nickname'],
     	);
        if($userModel->updateById($id, $data, 'id')) {
             $this->redirect('index.php?p=backend&c=User&a=getList', '更新成功');
        } else {
        	$this->redirect('index.php?p=backend&c=User&a=update&id='.$id, '更新失败');
        }
     } else {
     	   $user = $userModel->findOneById($id);
     	   $this->loadHtml('user/useredit', array('user'=>$user));
     }
	}
   

   public function login()
   {
    //var_dump($_POST['edtCaptcha']);die;
   	if(!empty($_POST)) {
   		//验证验证码是否正确
   		if($_POST['edtCaptcha'] != $_SESSION['captchaCode']) {
   			$this->redirect('index.php?p=backend&c=User&a=login', '验证码错误');
   			exit(0);
   		}

   		$userModel = UserModel::create();
   		$_POST['username'] = addslashes($_POST['username']);
   		$user = $userModel->findOneBy("password='{$_POST['password']}' and username = '{$_POST['username']}'");
   		//var_dump($user);die;
   		if(!empty($user)) {
   			//用户登录成功
   			$_SESSION['loginFlag'] = true;//登录成功  给一个标志
        $_SESSION['user'] = $user;
   			$this->redirect('index.php?p=backend&c=Index&a=index', '登录成功');
   		} else {
   			//用户登录 失败
   			$_SESSION['loginFlag'] = false;
   			$this->redirect('index.php?p=index.php&c=User&a=login', '登录失败');
   		}
   	} else {
   		$this->loadHtml('user/login');
   	}
  
  }

  public function logout()
  {
  	$_SESSION['loginFlag'] = false;
  	$this->loadHtml('user/login','退出成功');
  }

  public function captcha()
  {
  	$c = new \vendor\Captcha();
  	$c->generateCode();
  	$_SESSION['captchaCode'] = $c->getCode();
  }
}