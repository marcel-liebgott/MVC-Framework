<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');	
}

class FW_Front_index extends FW_MVC_Controller_default implements FW_Interface_Controller{
	public function __construct(){
		parent::__construct();
		$this->page->setTemplate("inc/standard_page");
	}

	public function index(){
		$updateAvailable = FW_VersionCompare::checkForUpdate();

		// current user
		$user = FW_Session::get(CURRENT_SESSION_USER);
		
		if($user === null || !isset($user)){
			$user = new FW_User_Data();
		}
		
		$groups = $user->getGroup();
		
		$this->view->addVariables(array(
			'updateAvailable' => (int) $updateAvailable,
			'username' => $user->getUserData(FW_DB_TBL_USER_NAME),
			'loggedin' => $user->isLoggedin(),
			'usergroups' => $groups
		));
		
		//$this->view->render('index/index');
		
		$this->view->setUseHeadline(true);
		$this->view->setUseFooter(true);
		$this->page->render();
	}
}
?>
