<?php
class FW_Test_ArrayTest extends FW_Test_BasicTestModul implements FW_Test_BasicTest{
	public function __construct(){
		parent::__construct();
		
		$this->_testName = get_class($this);
	}
	
	public function run(){
		parent::startProfiler();
		
		$array = array(
			"key1" => "value1",
			"key2" => "value2",
			"key3" => "value3"
		);
		$result = array();
		$true = intval(true);
		$false = intval(false);
		
		$arrayFW = new FW_Array($array);
		$arrayFW->add(array("key4" => "value4"));
		$arrayFW->add("value5");
		
		if($arrayFW->size() == 5){
			$result[] = $true;
		}else{
			$result[] = $false;
		}
		
		if($arrayFW->get("key2") == "value2"){
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