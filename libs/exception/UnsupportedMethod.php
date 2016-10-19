<?php
/**
 * unsupported method exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Exception_UnsupportedMethod extends FW_Exception_Critical{
	/**
	 * constructor
	 * 
	 * @access public
	 * @param string $message
	 */
	public function __construct($message){
		$msg = "unsupported Method: " . $$message;
		parent::__construct($msg);
	}
}
?>
