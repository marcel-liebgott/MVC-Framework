<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Test_SocketTest extends FW_Test_BasicTestModul implements FW_Test_BasicTest{
	/**
	 * FW_Socket instance
	 * 
	 * @var instance
	 */
	private $_socket = null;
	
	/**
	 * some static properties to run this test
	 * 
	 * @access private
	 * @var String
	 */
	private $_host = "demo.mliebgott.de";
	private $_path = "/mvc_fw/fwversion/fw.txt";
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function __construct(){
		parent::__construct();
		
		$this->_testName = get_class($this);
	}
	
	public function run(){
		$this->_socket = new FW_Socket($this->_host);
		$data = $this->_socket->post($this->_path, null);
		parent::endProfiler();
		
		if($data != null && $data != ""){
			$this->_result = true;
		}else{
			$this->_result = false;
		}
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