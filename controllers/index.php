<?php
class index extends FW_Mvc_Controller{
	public function __construct(){
		parent::__construct();

		echo "__construct-Funktion<br>";
	}

	public function index(){
		echo "index-Funktion<br>";
		$this->view->render('index/index');
	}
}
?>