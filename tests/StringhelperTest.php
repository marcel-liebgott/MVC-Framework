<?php
class StringhelperTest extends PHPUnit_Framework_TestCase{
	public function test_cleanDate(){
		$date = '10.01.2017';
		$date2 = '1001.01.2017';

		$this->assertEquals($date, FW_Stringhelper::getCleanDate($date));
		$this->assertEquals('', FW_Stringhelper::getCleanDate($date2));
	}

	public function test_convertSize(){
		$size = 1024 * 1024 * 1024;

		$this->assertEquals('1GB', FW_Stringhelper::convertSize($size));
	}

	public function test_validMail(){
		$mail = "marcel@mliebgott.de";
		$mail2 = "marcel@marcel@mliebgott.de";

		$this->assertTrue(FW_Stringhelper::isValidMail($mail));
		$this->assertFalse(FW_Stringhelper::isValidMail($mail2));
	}

	public function test_validUrl(){
		$url = "http://www.mliebgott.de";
		$url2 = "www.mliebgott%.de";

		$this->assertTrue(FW_Stringhelper::isValidUrl($url));
		$this->assertFalse(FW_Stringhelper::isValidUrl($url2));
	}
}
?>