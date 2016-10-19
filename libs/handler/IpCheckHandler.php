<?php
/**
 * a handler which is check the visitor ip adress
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Handler_IpCheckHandler implements FW_Interface_EventHandler{
	/**
	 * all blocked ips
	 * 
	 * @access protected
	 * @var array
	 */
	protected $blockedIps;

	/**
	 * constructor
	 * 
	 * @access public
	 * @param array $blockedIps
	 */
	public function __construct($blockedIps){
		$this->blockedIps = $blockedIps;
	}

	/**
	 * event listener
	 * 
	 * @access public
	 * @param FW_Event $event
	 */
	public function listen(FW_Event $event){
		$request = FW_Registry::getInstance()->getRequest();
		$ipAdress = $request->getIpAdress();

		if(in_array($ipAdress, $this->blockedIps)){
			$event->cancel();
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FW_Interface_EventHandler::handle()
	 */
	public function handle($event){
		
	}
}
?>
