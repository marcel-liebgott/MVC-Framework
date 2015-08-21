<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

$protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == '1' || strtolower($_SERVER['HTTPS'])=='on')) ? 'https' : 'http';

define('PATH', $protocol . '://' . $_SERVER['SERVER_NAME'] . '/' . basename(realpath('.')) . '/');

require_once '../config/config.php';
require_once './Autoload.php';

try{
	$autoload = new FW_TestAutoload("FW_");
	$autoload->register();
	
	$socket = new FW_Test_SocketTest();
	$socket->run();
	$socket->printResult();
	
	$ftp = new FW_Test_FtpTest();
	$ftp->run();
	$ftp->printResult();
	
	$string = new FW_Test_StringTest();
	$string->run();
	$string->printResult();
}catch(Exception $e){
	echo "Exception caught: " . $e->getMessage() . '<br>';
	echo "Line: " . $e->getLine() . '<br>';
	echo "File: " . $e->getFile();
}
?>