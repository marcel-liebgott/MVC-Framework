<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

final class FW_Exception_QueryFailure extends FW_Excpetion_Critical{
	/**
	 * constructor
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param int
	 */
	public function __construct($message, $query, $number = 0){
		$msg = 'MySQL-Query failed: ' . $number . ': ' . $message . '\n';
		$msg .= 'MySql-Query: ' . $query;

		parent::__construct($msg, $number);
	}
}
?>