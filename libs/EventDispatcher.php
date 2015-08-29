<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

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
	 * @return resource
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
	 * @param FW_Event $event
	 * @param string $context
	 * @param string $info
	 */
	public function triggerEvent($event, $context = null, $info = null){
		if(!($event instanceof FW_Interface_Event)){
			$event = new FW_Event($event, $context, $info);
		}
		
		$eventName = $event->getName();
		
		if(!isset($this->_handlers[$eventName])){
			return $event;
		}
		
		foreach($this->_handlers[$eventName] as $handler){
			$handler->handle($event);
			
			if($event.isCanceled()){
				break;
			}
		}
		
		return $event;
	}
}
?>