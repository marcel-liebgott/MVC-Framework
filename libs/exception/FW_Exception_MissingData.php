<?php
if(!defined('PATH')){
	die("direct script access allowed");
}

class FW_Exception_MissingData extends FW_Exception{
	public function __construct($message){
		parent::__construct($message);
	}
}
?>