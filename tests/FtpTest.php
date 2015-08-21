<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

class FW_Test_FtpTest extends FW_Test_BasicTestModul implements FW_Test_BasicTest{
	/**
	 * FW_Ftp instance
	 * 
	 * @access private
	 * @var FW_Ftp
	 */
	private $_ftp = null;
	
	/**
	 * some properties for current test
	 * 
	 * @access private
	 * @var String
	 */
	private $_host = "speedtest.tele2.net";
	private $_port = 21;
	private $_user = "anonymous";
	private $_pass = "";
	private $_timeout = 90;
	
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
		parent::startProfiler();
		
		$this->_ftp = new FW_Ftp($this->_host, $this->_port, $this->_user, $this->_pass, $this->_timeout);
		$this->_ftp->connect();
		$list = $this->_ftp->getFileList('.');
		parent::endProfiler();
		
		if(count($list) > 0){
			$this->_result = true;
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