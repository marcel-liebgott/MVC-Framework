<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * Database Tables
 */
define('FW_DB_TABLE_USER',				DB_PREFIX . 'user');

/**
 * Database Table 'user'
 */
define('FW_DB_TBL_USER_ID',				'id');
define('FW_DB_TBL_USER_NAME',			'name');
define('FW_DB_TBL_USER_PASS',			'pass');
?>