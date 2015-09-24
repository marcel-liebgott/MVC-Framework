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
class FW_User_Data{
	/**
	 * all user data
	 * 
	 * @access private
	 * @var array
	 */
	private $_data;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.10
	 * @param arary $data
	 */
	public function __construct($data = array()){
		if($data == null || $data->size() == 0){
			$this->_data = new FW_Array();
			$lang = FW_Registry::getInstance()->getLanguage();
			$langGuest = $lang->getLangValue(GUEST_USER_NAME);
			
			$this->_data->add(array(
				FW_DB_TBL_USER_GROUP => GUEST_GROUP_GID,
				FW_DB_TBL_USER_ID => GUEST_GROUP_UID,
				FW_DB_TBL_USER_NAME => $langGuest
			));
		}else{
			$this->_data = new FW_Array($data);
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
		return $this->_data->get($key);
	}
	
	/**
	 * return all groups of given user
	 *
	 * @access public
	 * @since 1.01
	 * @return FW_Array
	 * @throws FW_Exception_DBFailure
	 */
	public function getGroup(){
		$gid = $this->_data->get(FW_DB_TBL_USER_GROUP);
		$uid = $this->_data->get(FW_DB_TBL_USER_ID);
		
		if($gid > 0){
			if(isset($uid) && $uid !== null ){
				if(isset($gid) && $gid !== null){
					$group = FW_DAO::getGroup()->getGroupById($gid);
		
					$this->_data->add(array(FW_DB_TABLE_GROUP => $group));
						
					return $group;
				}
			}else{
				throw new FW_Exception_Critical("user id is not provided - please select user data first");
			}
		}else{
			// guest user group
			$lang = FW_Registry::getInstance()->getLanguage();
			$guestName = $lang->getLangValue(GUEST_USER_NAME);
			
			return $guestName;
		}
	}
	
	/**
	 *  check if user is logged in
	 *
	 *  @access public
	 *  @since 1.02
	 *  @return boolean
	 */
	public function isLoggedin(){
		return $this->_data->get(FW_DB_TBL_USER_ID) > 0;
	}
	
	/**
	 * try to login a user
	 *
	 * @access public
	 * @since 1.02
	 * @param String $name
	 * @param String $pass
	 */
	public function login($name, $pass){
		if($name !== null && $pass !== null){
			$user = FW_DAO::getUser()->getUserByName($name);
			$cookie = FW_Registry::getInstance()->get('cookies');
				
			if($user !== null){
				$loggedin = $this->checkUser($name, $pass);
	
				if($loggedin){
					// store user in sessions
					FW_Session::set('user_' . $this->_data->get(FW_DB_TBL_USER_ID), serialize($user));
						
					if(USE_COOKIES){
						$cookie->setCookie('user', serialize($user));
					}
				}
			}
		}
	}
	
	/**
	 * logout the current user
	 *
	 * @access public
	 * @since 1.02
	 */
	public function logout(){
		$cookie = FW_Registry::get('cookies');
	
		$cookie->delete('user');
		FW_Session::remove('user_' . $this->_data->get(FW_DB_TBL_USER_ID));
	}
	
	/**
	 * check user
	 *
	 * @access public
	 * @since 1.02
	 * @param String $name
	 * @param String $pass
	 * @return boolean
	 */
	private function checkUser($name, $pass){
		if($this->_data == null){
			throw new FW_Exception_MissingData("user not found");
		}
	
		if($name !== $this->_data->get(FW_DB_TBL_USER_NAME)){
			return false;
		}
	
		if($pass !== $this->_data->get(FW_DB_TBL_USER_PASS)){
			return false;
		}
	
		return true;
	}
	
	/**
	 * serialize the current user data
	 *
	 * @access public
	 * @since 1.02
	 */
	public function serialize(){
		return serialize($this->_data);
	}
	
	/**
	 * unserialize the current user data
	 * 
	 * @access public
	 * @since 1.02
	 */
	public function unserialize(){
		return unserialize($this->_data);
	}
}
?>