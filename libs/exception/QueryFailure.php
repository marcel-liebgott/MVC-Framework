<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

final class FW_Exception_QueryFailure extends FW_Exception_Critical{
	/**
	 * constructor
	 *
	 * @access public
	 * @param string $message
	 * @param string $query
	 * @param int $number
	 */
	public function __construct($message, $query, $number = 0){
		$msg = 'MySQL-Query failed: ' . $number . ': ' . $message . '\n';
		$msg .= 'MySql-Query: ' . $query;

		parent::__construct($msg, $number);
	}
}
?>