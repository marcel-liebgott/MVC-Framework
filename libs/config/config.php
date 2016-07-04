<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * DO NOT EDIT SOMETHINK FROM HERE
 */

/**
 * version state
 */
define('STATE_PREALPHA',		1);
define('STATE_ALPHA',			2);
define('STATE_BETA',			3);
define('STATE_RELEASE',			4);
define('STATE_STABLE',			5);

/**
 * framework version as string
 */
define('FW_VERSION',			'1.01');

/**
 * framework version as integer 
 * needed for version compair
 */
define('FW_VERSION_ID',			101);

/**
 * framework version state
 * needed for version compair
 */
define('FW_VERSION_STATE',		STATE_BETA);

/**
 * host for version compair
 */
define('FW_HOST',				'www.mliebgott.de');

/**
 * path for version file
 */
define('FW_PATH',				'/fwversion/fw.txt');

/**
 * path to header file
 */
define('FW_TPL_HEADER',			'/inc/header.php');

/**
 * path to headline file
 */
define('FW_TPL_HEADLINE',		'/inc/headline.php');

/**
 * path to footer file
 */
define('FW_TPL_FOOTER',			'/inc/footer.php');
?>
