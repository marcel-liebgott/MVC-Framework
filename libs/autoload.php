<?php
require_once 'interface/autoload.php';

/**
 * autoload class
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.02
 * @since 1.01
 */
class FW_Autoload implements FW_Interface_Autoload{
	/**
	 * class prefix
	 * 
	 * @access private
	 * @static
	 * @var string
	 */
	private static $prefix;
	
	/**
	 * instance
	 * 
	 * @access private
	 * @static
	 * @var FW_Autoload
	 */
	private static $instance = null;
	
	/**
	 * get singleton instance
	 * 
	 * @access public
	 * @static
	 * @return FW_Autoload
	 */
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new FW_Autoload();
		}
		
		return self::$instance;
	}
	
	/**
	 * constructor
	 * 
	 * @access private
	 * @since 1.02
	 */
	private function __construct(){}
	
	/**
	 * copy constructor
	 * 
	 * @access private
	 * @since 1.02
	 */
	private function __copy(){}
	
	/**
	 * set class prefix
	 * 
	 * @access public
	 * @param String $prefix
	 */
	public function setPrefix($prefix){
		self::$prefix = $prefix;
	}
	
	/**
	 * register an autoloader
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function register(){
		spl_autoload_register('FW_Autoload::autoload');
	}
	
	/**
	 * handle class request
	 * 
	 * @access private
	 * @static
	 * @since 1.01
	 * @param string $class
	 */
	public static function autoload($class){
		if(substr($class, 0, 3) == self::$prefix){
			$class = substr($class, 3);
			
			$class = strtolower($class);
		
			$class_arr = explode('_', $class);
			
			for($i = 0; $i < count($class_arr) - 1; $i++){
				$class_arr[$i] = strtolower($class_arr[$i]);
			}
		
			$path = implode('/', $class_arr) . '.php';
			
			if(strtolower($class_arr[0]) === 'front'){
				require_once CONTROLLER_DIR . $path;
			}elseif(strtolower($class_arr[0]) === 'dao' && strtolower($class_arr[count($class_arr) - 1]) !== 'dao'){
				require_once $path;
			}else{
				require_once LIBS . $path;
			}
		}else{
			throw new FW_Exception_NotSupported("Class '" . $class . "' doesn't a enabled framework class");
		}
	}
	
	/**
	 * return the current class prefix
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getPrefix(){
		return $_prefix;
	}
}
?>

