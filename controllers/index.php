<?php
class index extends FW_Mvc_Controller{
	public function __construct(){
		parent::__construct();
		
		$this->addPostFilter(new FW_Filter_HttpAuthFilter(array('admin' => "admin")));
		
		$user = new FW_User_Storage();
		$user->getUserById(1);
		$user->getUserByName('Marcel');
	}

	public function index(){
		$this->view->render('index/index');
	}
}
?>