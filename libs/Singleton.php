<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * base class for all singletons
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
abstract class FW_Singleton{
	/**
	 * all instances
	 *
	 * @access private
	 * @var array
	 */
	private static $_instances = array();

	private static $_locked = true;

	/**
	 * get a singleton instance
	 *
	 * @access protected
	 * @static
	 * @since 1.01
	 * @param String $class
	 * @return object
	 */
	protected static function _getInstance($class){
		if(!isset(self::$_instances[$class])){
			self::$_locked = false;
			self::$_instances[$class] = new $class();
			self::$_locked = true;
		}

		return self::$_instances[$class];
	}

	/**
	 * constructor
	 *
	 * @access public
	 */
	public function __construct(){
		if(self::$_locked){
			echo "Exception";
		}
	}

	/**
	 * copy constructor
	 *
	 * @access public
	 */
	public function __clone(){}
}
?>gi