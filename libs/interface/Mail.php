<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

interface FW_Interface_Mail{
	/**
	 * this function descripe the generating of the mail header, attach attachment and mail body
	 * and send the mail
	 *
	 * @access public
	 */
	public function send();
}
?>