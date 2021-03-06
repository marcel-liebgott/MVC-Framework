<?php
/**
 * class to get additional user information
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 */
class FW_User_Data{
	/**
	 * all user data
	 * 
	 * @access private
	 * @var FW_Array
	 */
	private $_data;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @param array $data
	 */
	public function __construct($data = array()){
		if($data === null || count($data) == 0){
			$this->_data = new FW_Array();
			$lang = FW_Registry::getInstance()->getLanguage();
			$langGuest = "guest";
			
			if($lang != null){
				$langGuest = $lang->getLangValue(GUEST_USER_NAME);
			}
			
			$this->_data->add(array(
				FW_DB_TBL_USER_GROUP => GUEST_GROUP_GID,
				FW_DB_TBL_USER_ID => GUEST_GROUP_UID,
				FW_DB_TBL_USER_NAME => $langGuest
			));
		}else if(!($data instanceof FW_Array)){
			$this->_data = new FW_Array($data);
		}else{
			$this->_data = $data;
		}
	}
	
	/**
	 * return all user data
	 * 
	 * @access public
	 * @return array
	 */
	public function getUserAllData(){
		return $this->_data;
	}
	
	/**
	 * set a user data
	 * 
	 * @access public
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
	 * @param string $key
	 * @return string
	 */
	public function getUserData($key){
		$data = $this->_data->get($key);
		return $data;
	}
	
	/**
	 * return all groups of given user
	 *
	 * @access public
	 * @return FW_Array|string
	 * @throws FW_Exception_Critical
	 */
	public function getGroup(){
		$gid = $this->_data->get(FW_DB_TBL_USER_GROUP);
		$uid = $this->_data->get(FW_DB_TBL_USER_ID);
		
		if($gid > 0){
			if(isset($uid) && $uid !== null ){
				if(isset($gid) && $gid > 0){
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
	 *  @return boolean
	 */
	public function isLoggedin(){
		// exists an cookie
		$registry = FW_Registry::getInstance();
		
		if(FW_Cookie::existsCookie('user')){
			$userCookie = FW_Cookie::get('user');
			
			if($userCookie > 0){
				return true;
			}
		}
		
		
		return $this->_data->get(FW_DB_TBL_USER_ID) > 0;
	}
	
	/**
	 * try to login a user
	 *
	 * @access public
	 * @param String $name
	 * @param String $pass
	 * @return boolean
	 */
	public function login($name, $pass){
		if($name !== null && $pass !== null){
			$registry = FW_Registry::getInstance();
			$user = FW_DAO::getUser()->getUserByName($name);
			$cookie = $registry::get('cookies');
			$response = $registry->getResponse();
				
			if($user !== null){
				$userObject = new FW_User_Data($user);
				
				// check login data
				if($userObject->getUserData(FW_DB_TBL_USER_PASS) === $pass){
					$loggedin = $this->checkUser($name, $pass, $userObject);
					
					$uid = $userObject->getUserData(FW_DB_TBL_USER_ID);
		
					if($loggedin){
						// store user in sessions
						FW_Registry::set('user', $userObject);
						FW_Session::set(CURRENT_SESSION_USER, $uid);
					}
					
					// set cookie if it's enabled
					if(USE_COOKIES){
						$cookie->setCookie('user', $user->get(FW_DB_TBL_USER_ID));
					}
					
					// save current user into the regsitry
					FW_Registry::set('user', $userObject);
					
					return true;
				}else{
					// generate a notification
					return false;
				}
			}
		}
	}
	
	/**
	 * logout the current user
	 *
	 * @access public
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
	 * @throws FW_Exception_MissingData
	 * @param String $name
	 * @param String $pass
	 * @param FW_User_Data $user
	 * @return boolean
	 */
	private function checkUser($name, $pass, $user){
		if($user === null){
			throw new FW_Exception_MissingData("user not found");
		}
	
		if($name !== $user->getUserData(FW_DB_TBL_USER_NAME)){
			return false;
		}
	
		if($pass !== $user->getUserData(FW_DB_TBL_USER_PASS)){
			return false;
		}
	
		return true;
	}
}
?>
