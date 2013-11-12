<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once 'config/config.php';
require_once CONFIG_DIR . SQL_FILE;

$protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == '1' || strtolower($_SERVER['HTTPS'])=='on')) ? 'https' : 'http';

define('PATH', $protocol . '://' . $_SERVER['SERVER_NAME'] . '/' . basename(realpath('.')) . '/');

function __autoload($class){
	if(substr($class, 0, 3) == "FW_"){
        $class = substr($class, 3);
        
        $class_arr = explode('_', $class);
        
        if(count($class_arr) == 2){
        	$path = LIBS . strtolower($class_arr[0]) . '/' . $class_arr[1] . '.php';
            require_once $path;
        }else{
            $path = LIBS . $class . '.php';
            require_once $path;
        }
    }else{
        die("Class '" . $class . "' doesn't a enabled framework class " . __CLASS__);
    }
}

try{
	$loader = new FW_Bootstrap();
	$loader->init();
}catch(Exception $e){
	echo "Exception caught: " . $e->getMessage();
}
?>