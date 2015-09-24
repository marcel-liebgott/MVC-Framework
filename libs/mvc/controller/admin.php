<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * this class represent an special controller for admin anly
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @abstract
 * @version 1.20
 */
abstract class FW_MVC_Controller_Admin extends FW_Abstract_Controller implements FW_Interface_Controller{
	/**
	 * constructor
	 * 
	 * @access protected
	 */
	public function __construct(){
		parent::__construct();
		
		$this->groupAccess();
		
		// guest doesn't have any access!
		$this->_guestAccess = false;
	}
	/**
	 * (non-PHPdoc)
	 * @see FW_Interface_Controller::groupAccess()
	 */
	public function groupAccess(){
		$this->addAccessGroup(FW_USER_GROUP_ADMIN_ID);
	}
}
?>