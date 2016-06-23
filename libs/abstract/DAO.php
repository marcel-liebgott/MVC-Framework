<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * basic class for all data access object
 *  
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
abstract class FW_Abstract_DAO extends FW_Singleton{
	/**
	 * database connection
	 * 
	 * @access protected
	 * @var FW_Database
	 */
	protected $_db;
	
	/**
	 * constructor
	 * 
	 * @access protected
	 */
	public function __construct(){
		$this->_db = FW_Registry::getInstance()->getDatabase();
	}
}
?>
