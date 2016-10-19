<?php
/**
 * auto logging class
 * 
 * @author Marcel Liebgott (marcel@mliebgott.de)
 * @since 1.00
 */
class FW_Handler_AuthLoggingHandler implements FW_Interface_EventHandler{
	protected $logFile;

	/**
	 * constructor
	 * 
	 * @param string $logFile
	 */
	public function __construct($logFile){
		$this->logFile = $logFile;
	}

	/**
	 * {@inheritDoc}
	 * @see FW_Interface_EventHandler::handle()
	 */
	public function handle(FW_Event $event){
		$authData = $event->getInfo();

		$fields = array(
			date('Y-m-d H:i:s'),
			$_SERVER['REMOTE_ADDR'],
			$event->getName(),
			$authData['user'],
			$authData['password']
		);

		error_log(implode('|', $fields) . '\n', 3, $this->logFile);
	}
}
?>
