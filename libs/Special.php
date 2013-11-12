<?php
if(!defined('PATH')){
	die("no direct script access allowed test");
}

class FW_Special{
	/**
	 * static instance of this class
	 *
	 * @access private
	 * @var instance
	 */
	private static $instance = null;

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
	 * @access public
	 */
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new FW_Special();
		}

		return self::$instance;
	}

	private function __construct(){
		$this->db = FW_Registry::getInstance()->getDatabase();
	}

	private function __clone(){
	}
}
?>