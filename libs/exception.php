<?php
/**
 * basic exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Exception extends Exception{
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $message
	 * @param int $code
	 */
    public function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}
?>
