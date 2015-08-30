<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_DAO_User extends FW_Abstract_DAO{
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}
	
	public function getUserById(){
	}
}
?>