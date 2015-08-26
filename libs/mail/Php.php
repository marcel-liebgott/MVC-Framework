<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * http://www.phpbuddy.eu/emails-mit-php-versenden.html?start=2
 *
 * @todo some default stuff
 *		subject
 */
final class FW_Mail_Php extends FW_Abstract_MailBase implements FW_Interface_Mail{
	/**
	 * constructor
	 */
	public function construct(){
		parent::__construct();
	}
	/**
	 * @see FW_Interface_Mail::send()
	 */
	public final function send(){
		$res = @mail($this->getReceiver(), $this->getSubject(), $this->getBody(), $this->getHeader());

		if(!$res){
			echo "some error with mail send";
			return false;
		}
		
		return true;
	}
}
?>