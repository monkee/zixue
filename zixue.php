<?php
/**
 * ����ļ����͸�һ���£�
 * 
 * 1. autoloader
 * 2. ���廷����������
 * 
 * @package zixue
 * @category Core
 * @author monkeehu(@126.com)
 * @copyright 2013-2014@zixue.it
 */

//1. ���廷������
define('DS', DIRECTORY_SEPARATOR);	//·���ָ���
define('ZIXUE', dirname(__FILE__) . DS); //��Ŀ¼

//2. ��������ļ�
include ZIXUE . 'Core' . DS . 'Zixue.class.php';