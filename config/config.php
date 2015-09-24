<?php
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
define('GUEST_GROUP_GID',			0);
define('GUEST_GROUP_UID',			0);

define('FW_USER_GROUP_ADMIN_ID',	1);

// defined application pages
<<<<<<< HEAD
define('FW_PAGE_404',				"error");
=======
define('FW_PAGE_404',				"error/accessDenied");
>>>>>>> origin/1.10-dev
define('FW_ACCESS_DENIED_PAGE',		FW_PAGE_404);
?>