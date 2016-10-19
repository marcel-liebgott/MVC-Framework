<?php
/**
 * a http based authentification filter
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Filter_HttpAuthFilter implements FW_Interface_Filter{
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
	 * @param array $authData
	 */
	public function __construct($authData){
		$this->authData = $authData;
	}

	/**
	 * (non-PHPdoc)
	 * @see FW_Interface_Filter::execute()
	 */
	public function execute($request, $response){
		$authData = $request->getAuthData();

		if($authData === null){
			$this->sendAuthRequest($response);
		}
		
		$username = $authData['user'];
		$password = $authData['password'];

		if(!isset($this->authData[$username]) || $this->authData[$password] !== $password){
			FW_EventDispatcher::getInstance()->triggerEvent('onInvalidLogin', $this, $authData);
			$this->sendAuthRequest($response);
		}

		$event = FW_EventDispatcher::getInstance()->triggerEvent('onLogin', $this, $authData);

		if($event->isCanceled()){
			$this->sendAuthRequest($response);
		}
	}

	/**
	 * send authorization request
	 * 
	 * @access private
	 * @param FW_Response $response
	 */
	private function sendAuthRequest(FW_Response $response){
		$response->setStatus('401 Unauthorized');
		$response->addHeader('WWW-Authenticate', 'Basic realm="Test"');
		$response->send();
		
		return;
	}
}
?>
