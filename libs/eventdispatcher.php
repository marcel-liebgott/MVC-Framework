<?php
/**
 * event dispatcher
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_EventDispatcher extends FW_Singleton{
	/**
	 * all event handler
	 * 
	 * @access private
	 * @var array
	 */
	private $_handlers = array();
	
	/**
	 * get singleton instance
	 * 
	 * @access public
	 * @static
	 * @return FW_EventDispatcher
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}
	
	/**
	 * add an handler
	 * 
	 * @access public
	 * @param String $eventName
	 * @param FW_EventHandler $handler
	 */
	public function addHandler($eventName, FW_Interface_EventHandler $handler){
		if(!isset($this->_handlers[$eventName])){
			$this->_handlers[$eventName] = array();
		}
		
		$this->_handlers[$eventName][] = $handler;
	}
	
	/**
	 * trigger an event
	 * 
	 * @access public
	 * @param string $event
	 * @param object $context
	 * @param array $info
	 * @return FW_Event
	 */
	public function triggerEvent($event, $context = null, $info = null){
		if(!($event instanceof FW_Interface_Event)){
			$newEvent = new FW_Event($event, $context, $info);
		}
		
		$eventName = $newEvent->getName();
		
		if(!isset($this->_handlers[$eventName])){
			return $newEvent;
		}
		
		foreach($this->_handlers[$eventName] as $handler){
			$handler->handle($newEvent);
			
			if($newEvent->isCanceled()){
				break;
			}
		}
		
		return $newEvent;
	}
}
?>
