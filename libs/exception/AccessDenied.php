<?php
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
