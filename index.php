<?php
if(!defined('PATH')){
	define('PATH', '');
}

$base_dir = __DIR__;
$doc_root = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '',$_SERVER['SCRIPT_FILENAME']);
$base_url = preg_replace("!^${doc_root}!", '', $base_dir);
$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$port = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
$domain = $_SERVER['SERVER_NAME'];
$full_url = "${protocol}://$domain$disp_port$base_dir";

define('DIR_PATH',  $protocol . '://' . $domain . '/' . $base_url . '/');
define('DOMAIN',	$domain);
define('PROTOCOL',	$protocol);
define('PORT',		$port);
define('DOC_ROOT',	$doc_root);
define('BASE_URL',	$base_url);
define('FULL_URL',	$full_url);

require_once 'config/config.php';
require_once 'libs/config/config.php';
require_once CONFIG_DIR . SQL_FILE;
require_once 'libs/autoload.php';

if(DEBUG_MODE){
	@ini_set('display_errors', 1);
	@ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

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
