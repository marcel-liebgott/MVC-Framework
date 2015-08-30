<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * managed class for all dao instances
 * @author marcel
 *
 */
final class FW_DAO extends FW_Singleton{
	public static function getInstance(){
		return parent::_getInstance(get_class($this));
	}
	
	public static function getUser(){
		return FW_DAO_User::getInstance();
	}
}
?>