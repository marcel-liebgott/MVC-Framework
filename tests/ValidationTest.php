<?php
define('PATH', '');

include_once 'libs/validate.php';
include_once 'libs/singleton.php';
include_once 'libs/registry.php';
include_once 'libs/exception.php';
include_once 'libs/exception/Critical.php';
include_once 'libs/exception/WrongParameter.php';

class ValidationTest extends PHPUnit_Framework_TestCase{
	private $string = "MVC-Framework";
	
	public function test_minLengthTrue(){
		$this->assertTrue(FW_Validate::minLength($this->string, 10));
	}
	
	public function test_minLengthFalse(){
		$this->assertFalse(FW_Validate::minLength($this->string, 20));
	}
	
	public function test_maxLengthTrue(){
		$this->assertTrue(FW_Validate::maxLength($this->string, 20));
	}
	
	public function test_maxLengthFalse(){
		$this->assertFalse(FW_Validate::maxLength($this->string, 10));
	}
}
?>