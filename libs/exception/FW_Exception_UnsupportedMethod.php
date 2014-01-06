<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Exception_UnsupportedMethod extends FW_Exception{
	public function __construct($message){
		$msg = "unsupported Method: " . $$message;
		parent::__construct($msg);
	}
}
?>