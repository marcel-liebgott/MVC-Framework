<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

interface FW_Interface_EventHandler{
	public function handle(FW_Event $event);
}
?>