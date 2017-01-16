<?php

class TestController extends FW_MVC_Controller_Default{
	public function __construct(){
		parent::__constructor();
	}
}

class DefaultControllerTest extends PHPUnit_Framework_TestCase{
	public function test_defaultController(){
		$controller = new TestController();
		
		$this->assertTrue($controller->guestAccess);
		$this->assertTrue($controller->hasAccess(0));
		$this->assertFalse($controller->hasAccess(1));
	}
}
?>