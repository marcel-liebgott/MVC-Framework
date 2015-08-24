<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

class FW_Test_FeedTest extends FW_Test_BasicTestModul implements FW_Test_BasicTest{
	public function __construct(){
		parent::__construct();

		$this->_testName = get_class($this);
	}
	
	public function run(){
		parent::startProfiler();
		
		$time = time();
		$document = new FW_Feed_Document("Titel Document", $time);
		$document->getCategory("Category 1");
		$document->getLanguage("DE-de");
		
		$item = new FW_Feed_Item("1234", "Titel Item", "Beschreibung", $time, "www.google.de", "Marcel Liebgott", "Category 1.1", "link/zum/Kommentar");
		$document->addItem($item);
		
		$rss = new FW_Feed_RSS();
		$rss->render($document);
		
		if($rss !== ""){
			$this->_result = true;
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