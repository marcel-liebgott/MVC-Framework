<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * Database Tables
 */
define('FW_DB_TABLE_USER',				DB_PREFIX . 'user');
define('FW_DB_TABLE_GROUP',				DB_PREFIX . 'group');

/**
 * Database Table 'user'
 */
define('FW_DB_TBL_USER_ID',				'uid');
define('FW_DB_TBL_USER_NAME',			'u_name');
define('FW_DB_TBL_USER_PASS',			'u_pass');
define('FW_DB_TBL_USER_GROUP',			'u_group');

/**
 * Database Table 'group'
 */
define('FW_DB_TBL_GROUP_ID',			'gid');
define('FW_DB_TBL_GROUP_NAME',			'g_name');
?>