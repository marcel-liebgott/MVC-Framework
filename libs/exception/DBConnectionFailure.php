<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

final class FW_Exception_DBConnectionFailure extends FW_Exception_ConnectionFailure{
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