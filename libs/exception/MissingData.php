<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("direct script access allowed");
}

/**
 * missing data exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Exception_MissingData extends FW_Exception_Critical{
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
