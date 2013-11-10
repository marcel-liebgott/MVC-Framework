<?php
class test extends FW_Controller{
	public function __construct(){
		parent::__construct();
		echo "test acp controller<br>";
	}

	public function index(){
		echo "acp test index()<br>";
		$this->view->render('test/index');
	}

	public function test(){
		echo "test funktion in acp test controller<br>";
	}
}
?>