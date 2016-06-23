<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * class to represent a default controller class
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @abstract
 */
abstract class FW_MVC_Controller_Default extends FW_Abstract_Controller implements FW_Interface_ControllerType{
	/**
	 * constructor
	 * 
	 * @access protected
	 */
	protected function __constructor(){
		parent::__construct();
		
		$this->groupAccess();
		
		$this->_guestAccess = true;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FW_Interface_Controller::groupAccess()
	 */
	public function groupAccess(){
		$this->addAccessGroup(GUEST_GROUP_GID);
	}
}
?>
