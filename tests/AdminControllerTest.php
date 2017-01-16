<?php

class AdminController extends FW_MVC_Controller_Admin{
	public function __construct(){
		parent::__construct();
	}
}

class AdminControllerTest extends PHPUnit_Framework_TestCase{
	public function test_adminController(){
		$controller = new AdminController();

		$this->assertFalse($controller->guestAccess);
		$this->assertFalse($controller->hasAccess(0));
		$this->assertTrue($controller->hasAccess(1));
	}
}
?>