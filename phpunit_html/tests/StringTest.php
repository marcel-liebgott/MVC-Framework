<?php
include_once '../../libs/string.php';

class StringTest extends PHPUnit_Framework_TestCase{
	private $string = "MVC-Framework";
	private $mailMatcher;
	
	public function test_substr(){
		$result = "Framework";
		
		$substr = FW_String::substr($this->string, 4);
		
		$this->assertEquals($result,$substr);
	}
	
	public function test_substrLenght(){
		$expected = "MVC";
		
		$substr = FW_String::substr($this->string, 0, 3);
		
		$this->assertEquals($substr, $expected);
	}
	
	public function test_strlen(){
		$expected = 13;
		
		$lenght = FW_String::strlen($this->string);
		
		$this->assertEquals($lenght, $expected);
	}
	
	public function test_strtolower(){
		$expected = "mvc-framework";
		
		$result = FW_String::strtolower($this->string);
		
		$this->assertEquals($expected, $result);
	}
	
	public function test_strtoupper(){
		$expected = "MVC-FRAMEWORK";
		
		$result = FW_String::strtoupper($this->string);
		
		$this->assertEquals($expected, $result);
	}
	
	public function test_strpos(){
		$expected = 3;
		
		$result = FW_String::strpos($this->string, '-');
		
		$this->assertEquals($result, $expected);
	}
	
	public function test_substrCount(){
		$expected = 1;
		
		$result = FW_String::substrCount($this->string, '-');
		
		$this->assertEquals($expected, $result);
	}
}
?>