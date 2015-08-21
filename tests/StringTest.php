<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

class FW_Test_StringTest extends FW_Test_BasicTestModul implements FW_Test_BasicTest{
	private static $_stringValue = "Hello World!";
	
	public function __construct(){
		parent::__construct();
		
		$this->_testName = get_class($this);
	}
	
	public function run(){
		parent::startProfiler();
		
		$result = array();
		$true = intval(true);
		$false = intval(false);
		
		$string = new FW_String(self::$_stringValue);
		
		if(FW_String::substr($string, 0, 5) == "Hello"){
			$result[] = $true;
		}else{
			$result[] = $false;
		}
		
		if(FW_String::strlen($string) == 12){
			$result[] = $true;
		}else{
			$result[] = $false;
		}
		
		if(FW_String::strpos($string, "o") === 4){
			$result[] = $true;
		}else{
			$result[] = $false;
		}
		
		if(FW_String::strtolower($string) == strtolower($string)){
			$result[] = $true;
		}else{
			$result[] = $false;
		}
		
		if(FW_String::strtoupper($string) == strtoupper($string)){
			$result[] = $true;
		}else{
			$result[] = $false;
		}

		if(FW_String::substrCount($string, "el") == 1){
			$result[] = $true;
		}else{
			$result[] = $false;
		}
		
		$return = true;
		
		foreach($result as $res){
			if($res == intval(false)){
				$return = false;
			}
		}
		
		$this->_result = $return;
		
		parent::endProfiler();
	}
	
	public function getResult(){
		$result = array(
			'result' => $this->_result,
			'time' => $this->getTime(),
			'memory' => $this->getMemory()
		);
		
		return $result;
	}
	
	public function printResult(){
		echo '<h3>' . $this->_testName . '</h3>';
		echo '<ul>';
		echo '<li>Result: ' . ($this->_result ? "true" : "false") . '</li>';
		echo '<li>Time: ' . $this->getTime() . '</li>';
		echo '<li>Memory: ' . $this->getMemory() . '</li>';
		echo '</ul>';
	}
}
?>