<?php
class Core_Exception_Message extends Core_Exception
{
	private $data = array();
	private $extra = "";
	public function __construct($message, $code = 0, $data = array(), $extra = ""){
		$this->data = $data;
		$this->extra = $extra;
		parent::__construct($message, $code);
	}
	
	public function asArray(){
		$data = $this->data;
		$data['code'] = $this->getCode();
		$data['message'] = $this->getMessage();
		
		return $data;
	}
}