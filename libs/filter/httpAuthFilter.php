<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Filter_HttpAuthFilter implements FW_Filter{
	/**
	 * authentification data
	 *
	 * @access private
	 * @var array
	 */
	private $authData;

	/**
	 * construct
	 *
	 * @access public
	 * @param array
	 */
	public function __construct($authData){
		$this->authData = $authData;
	}

	public function execute(FW_Request $request, FW_Response $response){
		$authData = $request->getAuthorization();

		if($authData == null){
			$this->sendAuthRequest($response);
		}

		$username = $authData[0];
		$password = $authData[1];

		if(!isset($this->authData[$username]) || $this->authData[$password] !== $password){
			FW_EventDispatcher::getInstance()->triggerEvent('onInvalidLogin', $this, $authData);
			$this->sendAuthData($response);
		}

		$event = FW_EventDispatcher::getInstance()->triggerEvent('onLogin', $this, $authData);

		if($event->isCancelled()){
			$this->sendAuthRequest($response);
		}
	}

	private function sendAuthData(FW_Response $response){
		$response->setStatus('401 Unauthorized');
		$response->addHeader('WWW-Authenticate', 'Basic realm="Test"');
		$response->send();
		exit();
	}
}
?>