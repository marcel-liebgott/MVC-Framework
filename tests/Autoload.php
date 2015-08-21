<?php
class FW_TestAutoload{
	private $_prefix = null;
	
	public function __construct($prefix){
		$this->_prefix = $prefix;
	}
	
	public function register(){
		spl_autoload_register(array($this, 'autoload'));
	}
	
	public function autoload($class){
		if(substr($class, 0, 3) == $this->_prefix){
			$class = substr($class, 3);
		
			$class_arr = explode('_', $class);
			
			for($i = 0; $i < count($class_arr) - 1; $i++){
				$class_arr[$i] = strtolower($class_arr[$i]);
			}
			
			if(strtolower($class_arr[0]) == "test"){
				$class_arr = array_splice($class_arr, 1, count($class_arr));
				
				$path = implode('/', $class_arr) . '.php';
			}else{
				$path = implode('/', $class_arr) . '.php';
				$path = "../" . LIBS . $path;
			}
			
			require_once $path;
		}else{
			die("Class '" . $class . "' doesn't a enabled framework class " . __CLASS__);
		}
	}
}
?>