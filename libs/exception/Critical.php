<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Exception_Critical extends FW_Exception{
	public function __construct($message, $code = 0){
		parent::__construct($message, $code);
	}
}
?>