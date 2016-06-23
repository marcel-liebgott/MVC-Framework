<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed");
}

/**
 * access denied exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Exception_AccessDenied extends FW_Exception_Critical{
	/**
	 * constructor
	 * 
	 * @access public
	 * @param string $message
	 */
	public function __construct($message){
		parent::__construct($message);
	}
}
?>
