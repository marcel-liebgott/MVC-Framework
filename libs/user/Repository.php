<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

class FW_User_Repository extends FW_Singleton{
	/**
	 * data access object for all users
	 * 
	 * @access private
	 * @var FW_DAO_User
	 */
	private $_dao;
	/**
     * get instance
     *
     * @access public
     * @static
     * @return resource
     */
public static function getInstance(){
        return parent::_getInstance(get_class());
    }
	
	public function __construct(){
		$this->_dao = FW_DAO::getUser();
		$this->_dao->getUserById();
	}
	
	public function getUserById($id){
		if(FW_Validate::isInteger($id) && $id > 0){
			
		}
	}
}
?>