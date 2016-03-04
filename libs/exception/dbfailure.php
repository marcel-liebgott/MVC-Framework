<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * database failure exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Exception_DBFailure extends FW_Exception{
	/**
	 * constructor
	 * 
	 * @access public
	 * @param string $message
	 * @param int $number
	 */
	public function __construct($message, $number){
		$msg = 'Could not connect to Database <br>';

		if($message){
			if($number > 0){
				$msg .= $number . ': ';
			}

			$msg .= $message;
		}

		parent::__construct($msg, $number);
	}
}
?>