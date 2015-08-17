<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

abstract class FW_Abstract_Database extends FW_Singleton{
	public static function __getInstance($class){
		return FW_Singleton::_getInstance($class);
	}
}
?>