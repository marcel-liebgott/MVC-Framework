<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

$protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == '1' || strtolower($_SERVER['HTTPS'])=='on')) ? 'https' : 'http';

define('PATH', $protocol . '://' . $_SERVER['SERVER_NAME'] . '/' . basename(realpath('.')) . '/');

require_once 'config/config.php';
require_once 'libs/config/config.php';
require_once CONFIG_DIR . SQL_FILE;
require_once 'libs/Autoload.php';

try{
	$autoloader = FW_Autoload::getInstance();
	$autoloader->setPrefix("FW_");
	$autoloader->register();
	
	$loader = FW_Bootstrap::getInstance();
	$loader->init();
}catch(FW_Exception $e){
	echo "Exception caught: " . $e->getMessage() . '<br>';
    echo "Line: " . $e->getLine() . '<br>';
    echo "File: " . $e->getFile();
}
?>