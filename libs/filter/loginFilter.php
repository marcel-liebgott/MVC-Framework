<?php
if(!defined('PATH')){
	die('no direct script access alloowed');
}

class FW_Filter_loginFilter implements FW_Interface_Filter{
	public function __construct(){
	}

	public function execute(FW_Request $request, FW_Response $response){
		FW_Session::init();
		$logged = FW_Session::get('sessionId');
                
		if($logged == false){
			$this->redirectToLogin();
		}
	}

	private function redirectToLogin(){
		FW_Session::destroy();
		$response = FW_Registry::getInstance()->getResponse();
		$response->redirectUrl('acp/login/', true);
		exit;
	}
}
?>