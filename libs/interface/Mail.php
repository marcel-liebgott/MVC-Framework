<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * mail interface
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
interface FW_Interface_Mail{
	/**
	 * this function descripe the generating of the mail header, attach attachment and mail body
	 * and send the mail
	 *
	 * @access public
	 * @return boolean
	 */
	public function send();
}
?>
