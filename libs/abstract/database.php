<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * base database class
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
 */
abstract class FW_Abstract_Database extends FW_Singleton{
	/**
	 * return singleton instance
	 * 
	 * @access public
	 * @static
	 * @param resource $class
	 * @return FW_Abstract_Database
	 */
	public static function __getInstance($class){
		return parent::_getInstance($class);
	}
}
?>