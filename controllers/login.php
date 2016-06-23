<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

class FW_Front_login extends FW_MVC_Controller_Default implements FW_Interface_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$name = $this->request->getPost('name');
		$pass = $this->request->getPost("pass");
		$submit = $this->request->getPost("submit");
		
		if(isset($submit)){
			$user = new FW_User_Data();
			$user->login($name, $pass);
		}
		
	}
}
?>
