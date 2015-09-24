<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * basic class for all user groups
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
abstract class FW_Abstract_UserGroup{
	/**
	 * the group id
	 * 
	 * @access private
	 * @var int
	 */
	private $_groupId;
	
	/**
	 * is this user group for guest
	 * 
	 * @access private
	 * @var boolean
	 */
	private $_isGuest = false;
	
	/**
	 * the user group name
	 * 
	 * @access private
	 * @var String
	 */
	private $_groupName = null;
	
	/**
	 * is the user group for guest only
	 * 
	 * @access protected
	 * @since 1.10
	 * @return boolean
	 */
	protected function isGuest(){
		return $this->_isGuest;
	}
	
	/**
	 * set the property if the this user group is onyl for guest
	 * 
	 * @access protected
	 * @since 1.10
	 * @param boolean $isGuest
	 */
	protected function setIsGuest($isGuest){
		if(FW_Validate::isBool($isGuest)){
			$this->_isGuest = (bool) $isGuest;
		}
	}
	
	/**
	 * set the group id
	 * 
	 * @access protected
	 * @since 1.10
	 * @param int $id
	 */
	protected function setGroupId($id){
		// check if this id exits
		$ids = new FW_Array(FW_Registry::get('fw_user_groups_ids'));
		
		if(($ids == null && empty($ids)) || $ids->get($id) == false){
			$ids->add($id);
		}else{
			$id = FW_Random::getIntRandom();
			$ids->add($id);
		}
		
		if(FW_Validate::isInteger($id)){
			$this->_groupId = $id;
		}
	}
	
	/**
	 * return the group id
	 * 
	 * @access protected
	 * @since 1.10
	 * @return int
	 */
	protected function getGroupId(){
		return $this->_groupId;
	}
	
	/**
	 * set the name of the current user group
	 * 
	 * @access protected
	 * @since 1.10
	 * @param String $name
	 */
	protected function setGroupName($name){
		$this->_groupName = $name;
	}
	
	/**
	 * get the name of the user group
	 * 
	 * @access protected
	 * @since 1.10
	 */
	protected function getGroupName(){
		return $this->_groupName;
	}
}
?>