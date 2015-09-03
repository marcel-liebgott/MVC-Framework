<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

final class FW_Exception_DBFailure extends FW_Exception{
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