<?php

class ValidationTest extends PHPUnit_Framework_TestCase{
	private $string = "MVC-Framework";
	
	public function test_minLengthTrue(){
		$this->assertTrue(FW_Validate::minLength($this->string, 10));
	}
	
	public function test_maxLengthTrue(){
		$this->assertTrue(FW_Validate::maxLength($this->string, 20));
	}
	
	public function test_isLengthTrue(){
		$this->assertTrue(FW_Validate::isLength($this->string, 13));
	}
	
	public function test_isIntegerTrue(){
		$this->assertTrue(FW_Validate::isInteger(1));
	}
	
	public function test_isInRangeTrue(){
		$this->assertTrue(FW_Validate::inRange(1, 3, 2));
	}
	
	public function test_isStringTrue(){
		$this->assertTrue(FW_Validate::isString($this->string));
	}
	
	public function test_isNumericTrue(){
		$this->assertTrue(FW_Validate::isNumeric("1234"));
	}
	
	public function test_isFloatTrue(){
		$this->assertTrue(FW_Validate::isFloat(1234.1));
	}
	
	public function test_isBooleanTrue(){
		$this->assertTrue(FW_Validate::isBool(true));
	}
	
	public function test_isArrayTrue(){
		$array = array();
		$this->assertTrue(FW_Validate::isArray($array));
	}
	
	public function test_isMixedTrue(){
		$this->assertTrue(FW_Validate::isMixed($this->string . 123));
	}
	
	public function test_isValidMailTrue(){
		$this->assertTrue(FW_Validate::isValidMail("test@test.de"));
	}
	
	public function test_isValidUrlTrue(){
		$this->assertTrue(FW_Validate::isValidUrl("www.test.de"));
	}
	
	public function test_isValidDate(){
		$this->assertTrue(FW_Validate::isValidDate("24.12.2016"));
	}
}
?>