<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Handler_IpCheckHandler implements FW_Interface_EventHandler{
	protected $blockedIps;

	public function __construct($blockedIps){
		$this->blockedIps = $blockedIps;
	}

	public function listen(FW_Event $event){
		$request = FW_Registry::getInstance()->getRequest();
		$ipAdress = $request->getIpAdress();

		if(in_array($ipAdress, $this->blockedIps)){
			$event->cancel();
		}
	}
}
?>