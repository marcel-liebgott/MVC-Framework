<?php
include_once 'libs/validate.php';
include_once 'libs/singleton.php';
include_once 'libs/registry.php';
include_once 'libs/stringhelper.php';
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
	
	public function test_isLengthTrue(){
		$this->assertTrue(FW_Validate::isLength($this->string, 13));
	}
	
	public function test_isLengthFalse(){
		$this->assertFalse(FW_Validate::isLength($this->string, 14));
	}
	
	public function test_isIntegerTrue(){
		$this->assertTrue(FW_Validate::isInteger(1));
	}
	
	public function test_isIntegerFalse(){
		$this->assertFalse(FW_Validate::isInteger("1"));
	}
	
	public function test_isInRangeTrue(){
		$this->assertTrue(FW_Validate::inRange(1, 3, 2));
	}
	
	public function test_isInRangeFalse(){
		$this->assertFalse(FW_Validate::inRange(1, 3, 4));
	}
	
	public function test_isStringTrue(){
		$this->assertTrue(FW_Validate::isString($this->string));
	}
	
	public function test_isStringFalse(){
		$this->assertFalse(FW_Validate::isString(true));
	}
	
	public function test_isNumericTrue(){
		$this->assertTrue(FW_Validate::isNumeric("1234"));
	}
	
	public function test_isNumericFalse(){
		$this->assertFalse(FW_Validate::isNumeric("test1234"));
	}
	
	public function test_isFloatTrue(){
		$this->assertTrue(FW_Validate::isFloat(1234.1));
	}
	
	public function test_isFloatFalse(){
		$this->assertFalse(FW_Validate::isFloat("1234.1"));
	}
	
	public function test_isBooleanTrue(){
		$this->assertTrue(FW_Validate::isBool(true));
	}
	
	public function test_isBooleanFalse(){
		$this->assertFalse(FW_Validate::isBool(1));
	}
	
	public function test_isArrayTrue(){
		$array = array();
		$this->assertTrue(FW_Validate::isArray($array));
	}
	
	public function test_isArrayFalse(){
		$this->assertFalse(FW_Validate::isArray($this->string));
	}
	
	public function test_isMixedTrue(){
		$this->assertTrue(FW_Validate::isMixed($this->string . 123));
	}
	
	public function test_isMixedFalse(){
		$this->assertFalse(FW_Validate::isMixed("!?=/(&%$"));
	}
	
	public function test_isValidMailTrue(){
		$this->assertTrue(FW_Validate::isValidMail("test@test.de"));
	}
	
	public function test_isValidUrlTrue(){
		$this->assertTrue(FW_Validate::isValidUrl("www.test.de"));
	}
}
?>