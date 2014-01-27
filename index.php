<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once 'config/config.php';
require_once 'libs/config/config.php';
require_once CONFIG_DIR . SQL_FILE;

$protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == '1' || strtolower($_SERVER['HTTPS'])=='on')) ? 'https' : 'http';

define('PATH', $protocol . '://' . $_SERVER['SERVER_NAME'] . '/' . basename(realpath('.')) . '/');

function __autoload($class){
	if(substr($class, 0, 3) == "FW_"){
        $class = substr($class, 3);
        
        $class_arr = explode('_', $class);

        $path = implode('/', $class_arr) . '.php';

        require_once LIBS . $path;
    }else{
        die("Class '" . $class . "' doesn't a enabled framework class " . __CLASS__);
    }
}

try{
	$loader = FW_Bootstrap::getInstance();
	$loader->init();
}catch(FW_Exception_Exception $e){
	echo "Exception caught: " . $e->getMessage() . '<br>';
    echo "Line: " . $e->getLine() . '<br>';
    echo "File: " . $e->getFile();
}
?>