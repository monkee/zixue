<?php
/**
 * ������ܵĺ����ļ�
 * 
 * ������������
 * 1. ������ʼ�������������á�autoload��
 * 2. ���������·�ɣ�
 * 3. ����ִ�й���
 * 4. ���������json��html���ļ���smarty��
 * 
 * @package zixue
 * @category Core
 * @author monkeehu(@126.com)
 * @copyright 2013-2014@zixue.it
 */

class Core_Zixue
{
	/**
	 * �����ʵ�������֣��洢������
	 * 
	 * @var Zixue
	 */
	static private $instance = null;
	
	/********************************************
	 * STATIC METHOD
	 * ******************************************
	 */
	
	/**
	 * ��ȡZixue��ʵ��������
	 * 
	 * ���͵ĵ���ģʽ��д��
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
	 * ʹ�ø�autoload����ķ���
	 * 
	 * @param string $class ����
	 */
	static public function autoload($class){
		$classpath = str_replace('_', DS, $class);
		$classpath .= '.class.php';
		if(is_file($classpath)){
			include ZIXUE . DS . $classpath;
		}
	}
	
	/**
	 * ִ��http����
	 * 
	 * ��������Լ���֯�������exit(0)
	 */
	public function httpRequest(){
		$config = new Core_Config();
		$config->test();
	}
	
	/********************************************
	 * PRIVATE METHOD
	 * ******************************************
	 */
	private function __construct(){
		$this->initAutoload(); //��ʼ���Զ�����
		$this->initConfig(); //���ó�ʼ��
	}
	
	private function initAutoload(){
		spl_autoload_register(array(Core_Zixue, autoload));
	}
	
	private function initConfig(){
		
	}
}