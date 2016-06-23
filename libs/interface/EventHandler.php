<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed");
}

/**
 * event handler interface
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
interface FW_Interface_EventHandler{
	/**
	 * handle an event
	 * 
	 * @access public
	 * @param FW_Event $event
	 */
	public function handle(FW_Event $event);
}
?>
