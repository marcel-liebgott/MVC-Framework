<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * test mail functionality
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Test_MailTest extends FW_Test_BasicTestModul implements FW_Test_BasicTest{
	/**
	 * e-mail receiver
	 * 
	 * @access private
	 * @var String
	 */
	private $_receiver;
	
	public function __construct($receiver){
		parent::__construct();
		
		$this->_receiver = $receiver;
		
		$this->_testName = get_class($this);
	}
	
	public function run(){
		parent::startProfiler();
		
		$mail = new FW_Mail_Php();
		$mail->setFrom("Framework Test");
		$mail->setReceiver($this->_receiver);
		$mail->setReceiverName("Max Mustermann");
		$mail->setSubject("Subject of Framework-Test");
		
		if($mail->send()){
			$this->_result = true;
		}else{
			$this->_result = false;
		}
		
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