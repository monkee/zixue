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

class Core_Request
{
	private $router = null;
	private $config = null;
	private $system = array(
		'type' => 'html', //可选为：ajax|html
	);
	
	private $output = array(); //输出数据
	
	public function exec(){
		//1. 获取路由
		//2. 执行请求
		//3. 处理异常
		//4. 整理输出
		//5. 终止进程
	}
	/********************************************
	 * STATIC METHOD & PROTOTYPE
	 * ******************************************
	 */
	/**
	 * 单例的基础方法
	 * 
	 * @return Core_Request
	 */
	static public function instance(){
		if(empty(self::$request)){
			self::$request = new Core_Request();
		}
		return self::$request;
	}
	
	private function __construct(){}
	
	static private $request = null;
}