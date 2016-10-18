<?php

define('PATH', '');

include_once 'libs/string.php';

class StringTest extends PHPUnit_Framework_TestCase{
	private $string = "MVC-Framework";
	
	public function test_substr(){
		$result = "Framework";
		
		$substr = FW_String::substr($this->string, 4);
		
		$this->assertEquals($substr, $result);
	}
	
	public function test_substrLenght(){
		$result = "MVC";
		
		$substr = FW_String::substr($this->string, 0, 3);
		
		$this->assertEquals($substr, $result);
	}
	
	public function test_strlen(){
		$stringLenght = 13;
		
		$lenght = FW_String::strlen($this->string);
		
		$this->assertEquals($lenght, $stringLenght);
	}
	
	public function test_strtolower(){
		$lowercase = "mvc-framework";
		
		$result = FW_String::strtolower($this->string);
		
		$this->assertEquals($lowercase, $result);
	}
	
	public function test_strtoupper(){
		$uppercase = "MVC-FRAMEWORK";
		
		$result = FW_String::strtoupper($this->string);
		
		$this->assertEquals($uppercase, $result);
	}
}
?>