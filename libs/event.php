<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * class to define a event
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Event{
	/**
	 * event name
	 * 
	 * @access private
	 * @var String
	 */
	private $_name;
	
	/**
	 * event context
	 * 
	 * @access private
	 * @var String
	 */
	private $_context;
	
	/**
	 * event info
	 * 
	 * @access private
	 * @var String
	 */
	private $_info;
	
	/**
	 * is the current event canceled
	 * 
	 * @access private
	 * @var boolean
	 */
	private $_isCanceled;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @param String $name
	 * @param String $context
	 * @param String $info
	 */
	public function __construct($name, $context = null, $info = null){
		$this->_name = $name;
		$this->_context = $context;
		$this->_info = $info;
	}
	
	/**
	 * set event name
	 * 
	 * @access public
	 * @param String $name
	 */
	public function setName($name){
		$this->_name = $name;
	}
	
	/**
	 * get event name
	 * 
	 * @access public
	 * @return String
	 */
	public function getName(){
		return $this->_name;
	}
	
	/**
	 * set event context
	 * 
	 * @access public
	 * @param String $context
	 */
	public function setContext($context){
		$this->_context = $context;
	}
	
	/**
	 * get event context
	 * 
	 * @access public
	 * @return String
	 */
	public function getContext(){
		return $this->_context;
	}
	
	/**
	 * set event info
	 * 
	 * @access public
	 * @param String $info
	 */
	public function setInfo($info){
		$this->_info = $info;
	}
	
	/**
	 * get event info
	 * 
	 * @access public
	 * @return String
	 */
	public function getInfo(){
		return $this->info;
	}
	
	/**
	 * return event canceled status
	 * 
	 * @access public
	 * @return boolean
	 */
	public function isCanceled(){
		return $this->_isCanceled;
	}
	
	/**
	 * cancel the event
	 * 
	 * @access public
	 */
	public function cancel(){
		$this->_isCanceled = true;
	}
}
?>
