<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * class to get additional user information
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
class FW_User_Data extends FW_Singleton{
	/**
	 * all user data
	 * 
	 * @access private
	 * @var array
	 */
	private $_data;
	
	/**
	 * get singleton instance
	 * 
	 * @access public
	 * @static
	 * @return FW_User_Data
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class($this));
	}
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.10
	 * @param arary $data
	 */
	public function __construct($data){
		foreach($data as $key => $value){
			$this->setUserData($key, $value);
		}
	}
	
	/**
	 * return all user data
	 * 
	 * @access public
	 * @since 1.10
	 * @return array
	 */
	public function getUserAllData(){
		return $this->_data;
	}
	
	/**
	 * set a user data
	 * 
	 * @access public
	 * @since 1.10
	 * @param String $key
	 * @param String $value
	 */
	public function setUserData($key, $value){
		$this->_data[$key] = $value;
	}
	
	/**
	 * return a property from the user data
	 * 
	 * @access public
	 * @since 1.10
	 * @param String $key
	 */
	public function getUserData($key){
		if(!isset($this->_data[$key])){
			return $this->_data[$key];
		}
	}
}
?>