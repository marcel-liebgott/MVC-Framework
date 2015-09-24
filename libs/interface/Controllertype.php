<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * interface for all controller types
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.20
 */
interface FW_Interface_ControllerType{
	
	/**
	 * define which groups has access
	 * 
	 * @access public
	 * @since 1.20
	 */
	public function groupAccess();
}
?>