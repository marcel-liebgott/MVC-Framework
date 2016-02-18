<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

class FW_Exception_ConnectionFailure extends FW_Exception_Critical{
	/**
	 * constructor
	 *
	 * @access public
	 * @param string $message
	 * @param int $code
	 */
	public function __construct($message, $code = 0){
		parent::__construct($message, $code);
	}
}
?>