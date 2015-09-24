<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * managed class for all dao instances
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.02
 */
final class FW_DAO extends FW_Singleton{
	/**
	 * get singleton instance
	 * 
	 * @access public
	 * @static
	 * @return FW_Dao 
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class($this));
	}
	
	/**
	 * return user dao object
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return FW_DAO_User instance
	 */
	public static function getUser(){
		return FW_DAO_User::getInstance();
	}
	
	/**
	 * return user group instance
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return FW_DAO_UserGroup instance
	 */
	public static function getGroup(){
		return FW_DAO_UserGroup::getInstance();
	}
}
?>