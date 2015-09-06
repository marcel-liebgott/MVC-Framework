<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * Data access object for users
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
final class FW_DAO_User extends FW_Abstract_DAO{
	/**
	 * return singleton instance
	 * 
	 * @access public
	 * @static
	 * @since 1.10
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}
	
	/**
	 * get all user information by user id
	 * 
	 * @access public
	 * @since 1.10
	 * @param int $id
	 * @return array
	 */
	public function getUserById($id){
		$user = $this->_db->select(
				"SELECT * FROM " . FW_DB_TABLE_USER . " WHERE " . FW_DB_TBL_USER_ID . " = :id",
				array(':id' => $id));
		
		return $user;
	}
	
	/**
	 * return all user information  by user name
	 * 
	 * @access public
	 * @since 1.10
	 * @param String $name
	 * @return array
	 */
	public function getUserByName($name){
		$user = $this->_db->select(
				"SELECT * FROM " . FW_DB_TABLE_USER . " WHERE " . FW_DB_TBL_USER_NAME . " = :name",
				array(':name' => $name));
		
		return $user;
	}
}
?>