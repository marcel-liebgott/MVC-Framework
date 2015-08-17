<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * autoload class
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Autoload{
	/**
	 * class prefix
	 * 
	 * @access private
	 * @var String
	 */
	private $_prefix;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $prefix
	 */
	public function __construct($prefix){
		$this->_prefix = $prefix;
	}
	
	/**
	 * register an autoloader
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function register(){
		spl_autoload_register(array($this, 'autoload'));
	}
	
	/**
	 * handle class request
	 * 
	 * @access private
	 * @since 1.01
	 * @param String $class
	 */
	private function autoload($class){
		if(substr($class, 0, 3) == $this->_prefix){
			$class = substr($class, 3);
		
			$class_arr = explode('_', $class);
			
			for($i = 0; $i < count($class_arr) - 1; $i++){
				$class_arr[$i] = strtolower($class_arr[$i]);
			}
		
			$path = implode('/', $class_arr) . '.php';
		
			require_once LIBS . $path;
		}else{
			die("Class '" . $class . "' doesn't a enabled framework class " . __CLASS__);
		}
	}
}
?>