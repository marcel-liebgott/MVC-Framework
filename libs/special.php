<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed test");
}

class FW_Special extends FW_Singleton{
	/**
	 * database
	 *
	 * @access private
	 * @var FW_Database
	 */
	private $db;

	/**
	 * singleton instance
	 *
	 * @access public#
	 * @return object
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}

	/**
	 * constrcutor
	 * 
	 * @access public
	 */
	public function __construct(){
		$this->db = FW_Registry::getInstance()->getDatabase();
	}
}
?>
