<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed");
}

/**
 * not support exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Exception_NotSupported extends FW_Exception{
	/**
	 * constructor
	 * 
	 * @access public
	 * @param string $message
	 */
	public function __construct($message){
		$msg = $message . ' are not supported';

		parent::__construct($msg);
	}
}
?>
