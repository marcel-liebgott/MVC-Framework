<?php
class StringTest extends PHPUnit_Framework_TestCase{
	private $string = "MVC-Framework";
	private $mailMatcher;
	
	public function test_substr(){
		$result = "Framework";

		FW_String::setMbUsing(false);
		
		$substr = FW_String::substr($this->string, 4);
		
		$this->assertEquals($result, $substr);

		FW_String::setMbUsing(true);
		$substr = FW_String::substr($this->string, 4);	
		$this->assertEquals($result, $substr);
	}
	
	public function test_substrLenght(){
		$expected = "MVC";

		FW_String::setMbUsing(false);
		
		$substr = FW_String::substr($this->string, 0, 3);
		
		$this->assertEquals($substr, $expected);

		FW_String::setMbUsing(true);
		$substr = FW_String::substr($this->string, 0, 3);
		$this->assertEquals($substr, $expected);
	}
	
	public function test_strlen(){
		$expected = 13;

		FW_String::setMbUsing(false);
		
		$lenght = FW_String::strlen($this->string);
		
		$this->assertEquals($lenght, $expected);

		FW_String::setMbUsing(true);
		$lenght = FW_String::strlen($this->string);
		$this->assertEquals($lenght, $expected);
	}
	
	public function test_strtolower(){
		$expected = "mvc-framework";

		FW_String::setMbUsing(false);
		
		$result = FW_String::strtolower($this->string);
		
		$this->assertEquals($expected, $result);

		FW_String::setMbUsing(true);
		$result = FW_String::strtolower($this->string);
		$this->assertEquals($expected, $result);		
	}
	
	public function test_strtoupper(){
		$expected = "MVC-FRAMEWORK";

		FW_String::setMbUsing(false);
		
		$result = FW_String::strtoupper($this->string);
		
		$this->assertEquals($expected, $result);

		FW_String::setMbUsing(true);
		$result = FW_String::strtoupper($this->string);
		$this->assertEquals($expected, $result);
	}
	
	public function test_strpos(){
		$expected = 3;

		FW_String::setMbUsing(false);
		
		$result = FW_String::strpos($this->string, '-');
		
		$this->assertEquals($result, $expected);

		FW_String::setMbUsing(true);
		$result = FW_String::strpos($this->string, '-');
		$this->assertEquals($result, $expected);
	}
	
	public function test_substrCount(){
		$expected = 1;

		FW_String::setMbUsing(false);
		
		$result = FW_String::substrCount($this->string, '-');
		
		$this->assertEquals($expected, $result);

		FW_String::setMbUsing(true);
		$result = FW_String::substrCount($this->string, '-');
		$this->assertEquals($expected, $result);
	}

	public function test_encoding(){
		$encoding = "UTF-8";
		$string = new FW_String();
		FW_String::setMbUsing(true);
		$string->setEncoding($encoding);

		$this->assertEquals($encoding, $string->getEncoding());

		FW_String::setMbUsing(false);
		$this->assertEquals('', $string->getEncoding());
	}

	public function test_language(){
		$lang = FW_Locale::$de_de_country;
		$string = new FW_String();
		FW_String::setMbUsing(true);
		$string->setLanguage($lang);

		$this->assertEquals(FW_Locale::$de_de_name, $string->getLanguage());

		FW_String::setMbUsing(false);
		$this->assertEquals('', $string->getLanguage());
	}
	
	public function test_string(){
		$string = new FW_String($this->string);
		$this->assertEquals($this->string, $string->__toString());
	}
	
	public function test_mbUsing(){
		$this->assertFalse(FW_String::isMbUsing());
	}
}
?>