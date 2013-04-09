<?php
/**
 * 
 */


class Core_Config
{
	static private $data = array();
	
	/**
	 * 获取某个配置路径下的配置
	 * 
	 * @param string $path 配置路径，如：a/b/c 获取 conf/a.ini 内的[b]下c的值
	 */
	static public function get($path){
		$keys = explode('/', $path);
		$file = array_shift($keys);
		$conf = self::getFile($file);
		if(empty($keys)){
			return $conf;
		}
		foreach($keys as $key){
			if(is_array($conf) && isset($conf[$key])){
				$conf = $conf[$key];
			}else{
				return false;
			}
		}
		return $conf;
	}
	
	static private function getFile($key){
		if(!isset(self::$data[$key])){
			$file = ZIXUE_CONF . $key . '.ini';
			if(!is_file($file)){
				throw new Core_Exception_Fatal("Conf file {$file} is not exist!");
			}
			self::$data[$key] = parse_ini_file($file, TRUE);
		}
		return self::$data[$key];
	}
	private function __construct(){}
}