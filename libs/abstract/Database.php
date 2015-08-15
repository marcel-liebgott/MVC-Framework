<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

abstract class FW_Abstract_Database extends PDO{
	private static $instance = null;
	
	protected static function getInstance($class){
		
		return parent::_getInstance($class);
	}
}
?>