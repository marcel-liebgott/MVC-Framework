<?php

class ValidationTest extends PHPUnit_Framework_TestCase{
	private $string = "MVC-Framework";
	
	public function test_minLength(){
		$this->assertTrue(FW_Validate::minLength($this->string, 10));
		$this->assertFalse(FW_Validate::minLength($this->string, 15));
	}
	
	public function test_maxLength(){
		$this->assertTrue(FW_Validate::maxLength($this->string, 20));
		$this->assertFalse(FW_Validate::maxLength($this->string, 10));
	}
	
	public function test_isLength(){
		$this->assertTrue(FW_Validate::isLength($this->string, 13));
		$this->assertFalse(FW_Validate::isLength($this->string, 10));
	}
	
	public function test_isInteger(){
		$this->assertTrue(FW_Validate::isInteger(2));
		$this->assertFalse(FW_Validate::isInteger("test"));
	}
	
	public function test_isInRange(){
		$this->assertTrue(FW_Validate::inRange(1, 3, 2));
		$this->assertFalse(FW_Validate::inRange(1, 3, 4));
	}
	
	public function test_isString(){
		$this->assertTrue(FW_Validate::isString($this->string));
		$this->assertTrue(FW_Validate::isString(1));
	}
	
	public function test_isNumeric(){
		$this->assertTrue(FW_Validate::isNumeric("1234"));
		$this->assertFalse(FW_Validate::isNumeric("test"));
	}
	
	public function test_isFloat(){
		$this->assertTrue(FW_Validate::isFloat(1234.1));
		$this->assertFalse(FW_Validate::isFloat("test"));
	}
	
	public function test_isBoolean(){
		$this->assertTrue(FW_Validate::isBool(true));
		$this->assertFalse(FW_Validate::isBool("test"));
		$this->assertTrue(FW_Validate::isBoolean(true));
	}
	
	public function test_isArray(){
		$array = array();
		$this->assertTrue(FW_Validate::isArray($array));
		$this->assertFalse(FW_Validate::isArray("test"));
	}
	
	public function test_isMixed(){
		$this->assertTrue(FW_Validate::isMixed($this->string . 123));
		$this->assertFalse(FW_Validate::isMixed(null));
	}
	
	public function test_isValidMail(){
		$this->assertTrue(FW_Validate::isValidMail("test@test.de"));
		$this->assertFalse(FW_Validate::isValidMail("test@test@test.de"));
		$this->assertFalse(FW_Validate::isValidMail(""));
	}
	
	public function test_isValidUrl(){
		$this->assertTrue(FW_Validate::isValidUrl("www.test.de"));
		$this->assertFalse(FW_Validate::isValidUrl("www..test.de"));
	}
	
	public function test_isValidDate(){
		$this->assertTrue(FW_Validate::isValidDate("24.12.2016"));
		$this->assertFalse(FW_Validate::isValidDate("00.12.2016"));
		$this->assertFalse(FW_Validate::isValidDate("24..12.2016"));
		$this->assertFalse(FW_Validate::isValidDate("32.12.2016"));
	}
}
?>