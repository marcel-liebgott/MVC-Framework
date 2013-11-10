<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_EventDispatcher{
	static private $instance;

	/**
	 * all handlers
	 *
	 * @access private
	 * @var array
	 */
	private $handlers = array();

	static public function getInstance(){
		if(self::$instance === null){
			self::$instance = new FW_EventDispatcher();
		}

		return self::$instance;
	}

	public function __construct(){

	}

	public function __clone(){

	}

	public function addHandler($eventName, FW_EventHandler $handler){
		if(!isset($this->handlers[$eventName])){
			$this->handlers[$eventName] = array();
		}

		$this->handlers[$eventName][] = $handler;
	}

	public function triggerEvent($event, $context = null, $info = null){
		if(!$event instanceof FW_Event){
			$event = new FW_Event($event, $contexr, $info);
		}

		$eventName = $event->getName();

		if(!isset($this->handlers[$eventName])){
			return $event;
		}

		foreach($this->handlers[$eventName] as $handler){
			$handler->handle($event);

			if($event->isCancelled){
				break;
			}
		}

		return $event;
	}
}
?>