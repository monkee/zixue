<?php
/**
 * 整个框架的核心文件
 * 
 * 处理如下内容
 * 1. 环境初始化（常量、配置、autoload）
 * 2. 输入解析（路由）
 * 3. 调用执行规则
 * 4. 输出解析（json、html、文件、smarty）
 * 
 * @package zixue
 * @category Core
 * @author monkeehu(@126.com)
 * @copyright 2013-2014@zixue.it
 */

class Core_Zixue
{
	/**
	 * 对象的实例化部分，存储到这里
	 * 
	 * @var Zixue
	 */
	static private $instance = null;
	
	/********************************************
	 * STATIC METHOD
	 * ******************************************
	 */
	
	/**
	 * 获取Zixue的实例化对象
	 * 
	 * 典型的单例模式的写法
	 * 
	 * @return Zixue
	 */
	static public function instance(){
		if(empty(self::$instance)){
			self::$instance = new Core_Zixue();
		}
		return self::$instance;
	}
	
	/**
	 * 使用给autoload载入的方法
	 * 
	 * @param string $class 类名
	 */
	static public function autoload($class){
		$classpath = str_replace('_', DS, $class);
		$classpath .= '.class.php';
		if(is_file($classpath)){
			include ZIXUE . DS . $classpath;
		}
	}
	
	/**
	 * 执行http请求
	 * 
	 * 该请求会自己组织输出，并exit(0)
	 */
	public function httpRequest(){
		$httpRequest = Core_Request::instance();
		$httpRequest->exec();
	}
	
	/********************************************
	 * PRIVATE METHOD
	 * ******************************************
	 */
	private function __construct(){
		$this->initAutoload(); //初始化自动载入
		$this->initConfig(); //配置初始化
	}
	
	private function initAutoload(){
		spl_autoload_register(array(Core_Zixue, autoload));
	}
	
	private function initConfig(){
		
	}
}