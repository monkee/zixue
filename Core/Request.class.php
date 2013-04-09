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
	private $isError = false;
	private $tpl = "";
	
	private $output = array(); //输出数据
	
	public function exec(){
		$this->execAction();
		$this->execOutput();
		$this->execEnd();
	}
	
	private function execAction(){
		$router = Core_Router::instance();
		$action = $router->getAction();
		$method = $router->getMethod();
		if(!class_exists($action)){
			throw new Core_Exception_Fatal("Action {$action} is not exist!");
		}
		$actionObject = new $action();
		if(!method_exists($actionObject, $method)){
			throw new Core_Exception_Fatal("Action {$action} does not has method {$method}!");
		}
		
		try{
			$this->data = $actionObject->$method();
			$dir = $router->getPureAction();
			$this->tpl = "{$dir}/{$method}";
			$this->isError = false;
		}catch(Core_Exception_Message $e){
			$this->isError = true;
			$this->tpl = "message";
			$this->data = $e->asArray();
		}
	}
	
	private function execOutput(){
		if('html' == $this->system['type']){
			$smarty = new Lib_Smarty();
			$tpl = ZIXUE . Core_Config::get('global/smarty/template');
			$smarty->setTemplateDir($tpl);
			$tpl = ZIXUE . Core_Config::get('global/smarty/compile');
			$smarty->setCompileDir($tpl);
			$smarty->setCacheDir($tpl);
			$smarty->assign($this->data);
			$smarty->display($this->tpl . '.tpl');
		}elseif('json' == $this->system['type']){
			header("Content-Type:application/json;");
			echo json_encode($this->data);
		}
	}
	
	private function execEnd(){
		exit(0);
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