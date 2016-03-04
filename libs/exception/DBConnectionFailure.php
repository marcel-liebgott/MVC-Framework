<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * database connection exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Exception_DBConnectionFailure extends FW_Exception_ConnectionFailure{
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

		$msg .= '<br> Please check your connection settings!';

		parent::__construct($msg, $number);
	}
}
?>