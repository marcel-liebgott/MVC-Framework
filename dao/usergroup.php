<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * data access object for user groups
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
class FW_DAO_UserGroup extends FW_Abstract_DAO{
	/**
	 * return singleton instance
	 * 
	 * @access public
	 * @static
	 * @return FW_DAO_UserGroup
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}
	
	/**
	 * select a group by id
	 * 
	 * @access public
	 * @since 1.10
	 * @throws FW_Exception_MissingData
	 * @param int|string $id
	 * @return FW_Array
	 */
	public function getGroupById($id){
		if(FW_Validate::isInteger($id) && $id >= 0){
			$group = $this->_db->select("SELECT * FROM `" . FW_DB_TABLE_GROUP . "` WHERE " . FW_DB_TBL_GROUP_ID . " = :gid",
					array(':gid' => $id));
			
			return $group;
		}else{
			throw new FW_Exception_MissingData("user id must be provided");
		}
	}
	
	/**
	 * select a group by name
	 * 
	 * @access public
	 * @since 1.10
	 * @param String $name
	 * @return FW_Array
	 */
	public function getGroupByName($name){
		$group = $this->_db->select("SELECT * FROM " . FW_DB_TABLE_GROUP . " WHERE " . FW_DB_TBL_GROUP_NAME . " = :g_name",
				array(':g_name' => $name));
		
		return $group;
	}
	
	/**
	 * update a group by id
	 * 
	 * @access public
	 * @since 1.10
	 * @param int $id
	 * @param array $data
	 */
	public function updateGroupById($id, $data){
		$this->_db->update(FW_DB_TABLE_GROUP, $data, FW_DB_TBL_GROUP_ID . " = " . $id);
	}
	
	/**
	 * update a group by name
	 * 
	 *  @access public
	 *  @since 1.10
	 * @param String $name
	 * @param array $data
	 */
	public function updateGroupByName($name, $data){
		$this->_db->update(FW_DB_TABLE_GROUP, $data, FW_DB_TBL_GROUP_NAME . " = " . $name);
	}
}
?>