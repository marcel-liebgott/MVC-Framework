<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

final class FW_Exception_DBConnectionFailure extends FW_Exception{
	public function __construct($message, $number){
		$msg = 'Could not connect to Database';

		if($message){
			if($number > 0){
				$msg .= $number . ': ';
			}

			$msg .= $message;
		}

		$msg .= '\n' . 'Please check your connection settings!';

		parent::__construct($msg, $number);
	}
}
?>