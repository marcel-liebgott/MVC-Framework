<?php
class index extends FW_Mvc_Controller{
	public function __construct(){
		parent::__construct();
		
		$this->addPostFilter(new FW_Filter_HttpAuthFilter(array('admin' => "admin")));
		
		$user = FW_User_Repository::getInstance();
		
		$fields = $this->db->getTableInfos(FW_DB_TABLE_USER);
		echo '<pre>';
			print_r($fields);
		echo '</pre>';
	}

	public function index(){
		$this->view->render('index/index');
	}
}
?>