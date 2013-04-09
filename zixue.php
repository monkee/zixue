<?php
/**
 * 入口文件，就干一件事：
 * 
 * 1. autoloader
 * 2. 定义环境基本常量
 * 
 * @package zixue
 * @category Core
 * @author monkeehu(@126.com)
 * @copyright 2013-2014@zixue.it
 */

//1. 定义环境变量
define('DS', DIRECTORY_SEPARATOR);	//路径分隔符
define('ZIXUE', dirname(__FILE__) . DS); //根目录
define('ZIXUE_CONF', ZIXUE . 'conf' . DS); //配置目录

//2. 引入核心文件
include ZIXUE . 'Core' . DS . 'Zixue.class.php';