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
class FW_Autoload extends FW_Singleton implements FW_Interface_Autoload{
	/**
	 * class prefix
	 * 
	 * @access private
	 * @var String
	 */
	private $_prefix;
	
	/**
	 * get instance
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @param String $prefix
	 */
	public static function getInstance($prefix){
		$this->_prefix = $prefix;
		return parent::_getInstance(get_class($this));
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
			
			if(strtolower($class_arr[0]) === 'dao' && strtolower($class_arr[count($class_arr) - 1]) !== 'dao'){
				require_once $path;
			}else{
				require_once LIBS . $path;
			}
		}else{
			die("Class '" . $class . "' doesn't a enabled framework class " . __CLASS__);
		}
	}
}
?>
