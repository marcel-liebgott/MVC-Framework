<?php
if(!defined('PATH')){
	die('no direct script access alloowed');
}

/**
 * login filter 
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Filter_loginFilter implements FW_Interface_Filter{
	/**
	 * constructor
	 * 
	 * @access public
	 */
	public function __construct(){
	}

	/**
	 * {@inheritDoc}
	 * @see FW_Interface_Filter::execute()
	 */
	public function execute($request, $response){
		FW_Session::init();
		$logged = FW_Session::get('sessionId');
                
		if($logged === false){
			$this->redirectToLogin();
		}
	}

	/**
	 * redirect to login
	 *
	 * @access private
	 */
	private function redirectToLogin(){
		FW_Session::destroy();
		$response = FW_Registry::getInstance()->getResponse();
		$response->redirectUrl('acp/login/', true);
		exit;
	}
}
?>
