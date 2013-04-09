<?php
/**
 * 
 */

class Core_Exception_Fatal extends Exception
{
	public function __construct($message){
		parent::__construct($message, 0);
	}
}