<?php
/**
 * 路由处理
 * 
 * 目前我们只支持一种路由，即
 * /a/b/c => Action_A_B_C
 * /a/b/c-m => Action_A_B_C->m
 * 默认方法为：exec()
 * 
 * @package zixue
 * @category Core
 * @author monkeehu(@126.com)
 * @copyright 2013-2014@zixue.it
 */
class Core_Router
{
	private $action = 'Index';
	private $method = 'index';
	
	static private $router = null;
	
	static public function instance(){
		if(empty(self::$router)){
			self::$router = new Core_Router();
		}
		return self::$router;
	}
	
	public function getPureAction(){
		return $this->action;
	}
	
	/**
	 * 获取解析后的类
	 * 
	 * @return string
	 */
	public function getAction(){
		return "Action_" . $this->action;
	}
	
	/**
	 * 获取解析后的方法
	 * 
	 * @return string
	 */
	public function getMethod(){
		return $this->method;
	}
	
	/******************************************
	 * PRIVATE METHOD
	 * ****************************************
	 */
	private function __construct(){
		$this->init();
	}
	
	private function init(){
		$url = $_SERVER['REQUEST_URI'];
		if(preg_match("/^\/([a-z0-9\_\/]+)?(\-[a-z0-9\_]+)?/", $url, $m)){
			empty($m[1]) || $this->initAction($m[1]);
			empty($m[2]) || $this->initMethod($m[2]);
		}
	}
	
	/**
	 * 解析class的方法
	 * 
	 * 将 a/b/c/d的格式解析为 Action_A_B_C_D
	 * 
	 * @param string $class 格式为：a/b/c/d 末尾没有/
	 */
	private function initAction($class){
		if(empty($class)){
			return;
		}
		$prefixs = explode('/', $class);
		foreach($prefixs as &$prefix){
			$prefix = ucfirst($prefix);
		}
		$this->action = implode('_', $prefixs);
	}
	
	/**
	 * 解析method方法
	 * 
	 * 将"-***"解析为：method
	 * 
	 * @param string $method 输入为："-[a-z0-9_]"
	 */
	private function initMethod($method){
		$method = ltrim($method, '-');
		if(!empty($method)){
			$this->method = $method;
		}
	}
}