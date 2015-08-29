<?php
class index extends FW_Mvc_Controller{
	public function __construct(){
		parent::__construct();
		
		$this->addPostFilter(new FW_Filter_HttpAuthFilter(array('admin' => "admin")));
	}

	public function index(){
		$this->view->render('index/index');
	}
}
?>