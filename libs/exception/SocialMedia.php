<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}
class FW_Exception_SocialMedia extends FW_Exception_Critical{
	public function __construct($message, $code = 0){
		parent::__construct($message, $code);
	}
}
?>