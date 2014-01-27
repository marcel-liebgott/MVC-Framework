<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Exception_NotSupported extends FW_Exception{
	public function __construct($message){
		$msg = $message . ' are not supported';

		parent::__construct($msg);
	}
}
?>