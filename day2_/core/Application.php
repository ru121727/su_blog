<?php 
namespace core;

class Application
{
	public static $config ;
	public static function run()
	{
		
		//初始化字符集
		self::_initialCharset();

		//设定php的错误显示和错误级别
		self::_setPhpErrorDisplayAndErrorReport();

		//定义目录常量
		self::_defineDirConst();
		//加载配置文件
		self::_loadConfigFile();
		//解析url参数
		self::_parseUrlParams();
		//注册自动加载
		
		//self::_registerAutoLoad();
        require 'E:\xiangmu\blog\day2_\app\controller\backend\TestController.php';
		$test = new \app\controller\backend\TestController();
		var_dump($test->test);die;

		
		
	}

	//初始化字符集
	protected static function _initialCharset()
	{
		header("Content-type:text/html;charset=utf-8");
	}

	//设定PHP的错误显示和错误级别 error_reporting? diaplsy_errors?
	protected static function _setPhpErrorDisplayAndErrorReport()
	{
		//修改PHP的配置，只在当前的请求中有效
		ini_set('display_errors', 'on');
		//设定报错级别
		error_reporting(E_ALL);
	}

	//定义目录常量
	protected static function _defineDirConst()
	{
		//定义路径分隔符
		define('DS', DIRECTORY_SEPARATOR);
		//定义项目的根目录
		define('ROOT_PATH', dirname(__DIR__));
		//应用目录
		define('APP_PATH', ROOT_PATH .DS. 'app');
		//视图目录
		define('VIEW_PATH', APP_PATH . DS . 'view');
		//配置文件
		define('CONFIG_PATH', APP_PATH.DS. 'config');
	}

	//加载配置文件
	public static function _loadConfigFile()
	{
		require CONFIG_PATH .DS .'config.php';
		self::$config = $config;
	}

	//解析url参数
	protected static function _parseUrlParams()
	{
		//p a c 
		$p = isset($_GET['p']) ? $_GET['p'] : 'backend';
		$c = isset($_GET['c']) ? $_GET['c'] : 'Index';
		$a = isset($_GET['a']) ? $_GET['a'] : 'index';


		define('PLATFORM', $p);
		define('CONTROLLER', $c);
		define('ACTION', $a);
	}
	//注册自动加载
	protected static function _registerAutoLoad()
	{
		spl_autoload_register(function($className){
			//var_dump(ROOT_PATH);die;//string(37) "app\controller\backend\TestController"
			 require  ROOT_PATH . DS . str_replace('\\', '/', $className) . '.php';

		});
	} 


	

}