<?php
/**
 * collect all user data
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
class FW_User_Storage{
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.10
	 */
	public function __construct(){
	}
	
	/**
	 * return all user data by user id
	 * 
	 * @access public
	 * @since 1.10
	 * @param int $id
	 * @return FW_User_Data
	 */
	public function getUserById($id){
		$data = FW_DAO::getUser()->getUserById($id);
		
		return new FW_User_Data($data);
	}
	
	/**
	 * return all user data by user name
	 * 
	 * @access public
	 * @since 1.10
	 * @param String $name
	 * @return FW_User_Data
	 */
	public function getUserByName($name){
		$data = FW_DAO::getUser()->getUserByName($name);
		
		return new FW_User_Data($data);
	}
}
?>
