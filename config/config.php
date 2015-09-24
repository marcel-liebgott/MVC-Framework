<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

$base_dir = __DIR__;
$doc_root = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '',$_SERVER['SCRIPT_FILENAME']);
$base_url = preg_replace("!^${doc_root}!", '', $base_dir);
$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$port = $_SERVER['SERVER_PORT'];
$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
$domain = $_SERVER['SERVER_NAME'];
$full_url = "${protocol}://${domain}${disp_port}${base_dir}";

define('PATH',  $protocol . '://' . $domain . '/' . $base_url . '/');
define('DOMAIN',	$domain);
define('PROTOCOL',	$protocol);
define('PORT',		$port);
define('DOC_ROOT',	$doc_root);
define('BASE_URL',	$base_url);

/**
 * admin-modul indentificator
 */
define('ACP_IDENT',			'acp');

/**
 * default admin controller
 */
define('ACP_DEFAULT_CTR', 	'index');

/**
 * defined the library directory
 */
define('LIBS',				'libs/');

/**
 * defined the DaO directory
 */
define('DAO',				'dao/');

/**
 * defined the tests directory
 */
define('TESTS',				'tests/');

/**
 * directory for admin
 */
define('ACP_DIR',			'admin/');

/**
 * controller directory
 */
define('CONTROLLER_DIR',	'controllers/');

/**
 * model directory
 */
define('MODEL_DIR',			'models/');

/**
 * view directory
 */
define('VIEW_DIR',			'views/');

/**
 * interface directory
 */
define('INTERFACE_DIR',		'interface/');

/**
 * language directory
 */
define('LANG_DIR', 			'lang/');

/**
 * public source directory
 */
define('PUBLIC_DIR',		'public/');

/**
 * configuration directory
 */
define('CONFIG_DIR',		'config/');

/**
 * application configuration file
 */
define('CONFIG_FILE',		'config.ini');

/**
 * database file
 */
define('SQL_FILE',			'sql.php');

/**
 * define database prefix
 */
define('DB_PREFIX',			'fw_');

/**
 * application information
 */
// for other hash keys
define('HASH_GENERAL_KEY',      'o0G11X7qLqCQZbXS7aRil39sZH6Zm8glE0ZFcvWKTdTGGQFCjHxVyiWWe5dQ');

// for database passwords only
define('HASH_PASSWORD_KEY',     'aL4X1oO3atpcx9qL2TGTtmOn74D4dQ4OCg4qbwcNqNwm9grTzVVd4o7TDYKj');

// default lang
define('DEFAULT_LANG',		'de');

// download dir
define('DOWNLOAD_DIR',		'download/');

/**
 * database authetification
 */
define('TYPE',				'mysql');
define('HOST',				'localhost');
define('USER',				'root');
define('PASS',				'root');
define('DATA',				'mvc_fw');

// use cookies
define('USE_COOKIES',		true);
define('COOKIE_PREFIX',		'FW_');


// user
define('CURRENT_SESSION_USER',		'fw_curr_user');

// user group
define('GUEST_GROUP_UID',			0);
define('GUEST_GROUP_GID',			0);
define('GUEST_USER_NAME',			'guest');

define('FW_USER_GROUP_ADMIN_ID',	1);

// defined application pages
define('FW_PAGE_404',				'error/not_found');
define('FW_PAGE_403',				'error/access_denied');
define('FW_ACCESS_DENIED_PAGE',		FW_PAGE_403);
define('FW_NOT_FOUND_PAGE',			FW_PAGE_404);

// debug mode
define('DEBUG_MODE',				true);
?>