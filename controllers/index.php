<?php
if(!defined('PATH')){
	die('no direct script access allowed');	
}

class FW_Front_index extends FW_MVC_Controller_default implements FW_Interface_Controller{
	public function __construct(){
		parent::__construct();
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
		
		$this->addPostFilter(new FW_Filter_HttpAuthFilter(array('admin' => "admin")));
		
		$user = new FW_User_Storage();
		$user->getUserById(1);
		$user->getUserByName('Marcel');
=======
>>>>>>> origin/1.10-dev
=======
>>>>>>> master
=======
>>>>>>> master
	}

	public function index(){
		$updateAvailable = FW_VersionCompare::checkForUpdate();

		// current user
		$user = FW_Session::get(CURRENT_SESSION_USER);
		
		if($user == null || !isset($user)){
			$user = new FW_User_Data();
		}
		
		$groups = $user->getGroup();
		
		$this->view->addVariables(array(
			'updateAvailable' => (int) $updateAvailable,
			'username' => $user->getUserData(FW_DB_TBL_USER_NAME),
			'loggedin' => $user->isLoggedin(),
			'usergroups' => $groups
		));
		
		$this->view->render('index/index');
	}
}
?>