<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * database query failure exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Exception_QueryFailure extends FW_Exception_Critical{
	/**
	 * constructor
	 *
	 * @access public
	 * @param string $message
	 * @param string $query
	 */
	public function __construct($message, $query){
		$msg = 'MySQL-Query failed: ' . $message . '\n';
		$msg .= 'MySql-Query: ' . $query;

		parent::__construct($msg, 0);
	}
}
?>