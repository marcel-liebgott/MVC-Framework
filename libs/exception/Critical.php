<?php
/**
 * critical exception
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Exception_Critical extends FW_Exception{
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
