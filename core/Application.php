<?php
namespace core;

class Application
{

	public static $config;
	public static function run()
	{
		//开启session
		self::startSession();
		
		//初始化字符集
		self::_initialCharset();
		//设定php的错误显示和级别
		self::_setPhpErrorDisplayAndErrorReport();
		//自动加载
		self::_registerAutoload();
		//定义目录常量
		self::_defineDirConst();

		//加载配置文件
		self::_loadConfigFile();
		//解析url参数（路由参数）
		self::_parseUrlParams();

		//注册自动加载
		
		
		//分发路由

		self::_dispatchRoute();
	}

	protected static function startSession()
	{
		session_start();
	}

	//加载配置文件
	public static function _loadConfigFile()
	{
		require CONFIG_PATH . DS . 'config.php';

		self::$config = $config;
	}

	//注册自动 加载
	protected static function _registerAutoload()
	{
		spl_autoload_register(function($classname) {

        $fileName = ROOT_PATH . DS . str_replace('\\','/',$classname).'.php';
        if (is_file($fileName)) {
        	require $fileName;
        }
            
			//require ROOT_PATH . DS . str_replace('\\','/',$classname).'.php';
		});
	}

	protected static function _setPhpErrorDisplayAndErrorReport()
	{
		//修改php的配置，只在当前请求中有效
		ini_set('display_errors', 'On');
		//设定报错级别
		error_reporting(E_ALL);

	}

	//初始化字符集
	protected static function _initialCharset()
	{
		header('Content-type: text/html; charset=utf-8');
	}

	//定义常用的目录常量
	protected static function _defineDirConst()
	{
		//定义路径分隔符
		define('DS', DIRECTORY_SEPARATOR);
		//定义项目的根目录
		define('ROOT_PATH', dirname(__DIR__));
		//应用目录(app)
		define('APP_PATH', ROOT_PATH.DS.'app');
		//视图目录
		define('VIEW_PATH', APP_PATH.DS.'view');
		//配置文件目录
		define('CONFIG_PATH', APP_PATH.DS.'config');
	}

	protected static function _parseUrlParams()
	{
		//p a c 
		$p = isset($_GET['p']) ? $_GET['p'] : 'backend';
		$a = isset($_GET['a']) ? $_GET['a'] : 'index';
		$c = isset($_GET['c']) ? $_GET['c'] : 'index';

		define('PLATFORM', $p);
		define('ACTION', $a);
		define('CONTROLLER', $c);
	}
	//分发路由

	protected static function _dispatchRoute()
   {

    
   	$a = ACTION;
   	//$c = \app\controller\backend\
   	$c = '\\app\\controller\\'.PLATFORM.'\\'.CONTROLLER.'controller';
    $ctrl = new $c();
   	$ctrl->$a();
   }

}


