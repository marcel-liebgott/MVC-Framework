<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Handler_AuthLoggingHandler implements FW_Interface_EventHandler{
	protected $logFile;

	public function __construct($logFile){
		$this->logFile = $logFile;
	}

	public function handle(FW_Event $event){
		$authData = $event->getInfo();

		$fields = array(
			date('Y-m-d H:i:s'),
			$_SERVER['REMOTE_ADDR'],
			$event->getName(),
			$authData['user'],
			$authData['password']
		);

		error_log(implode('|', $fields) . '\n', 3, $this->logFile);
	}
}
?>