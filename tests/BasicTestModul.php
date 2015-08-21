<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

abstract class FW_Test_BasicTestModul{
	protected $_result = false;
	protected $_testName = null;
	private $_profiler = null;
	private $_neededTime = null;
	private $_neededMemory = null;
	
	protected function __construct(){
		$this->_profiler = new FW_Profiler();
	}
	
	protected function startProfiler(){
		$this->_profiler->start();
	}
	
	protected function endProfiler(){
		$this->_neededTime = $this->_profiler->getTime();
		$this->_neededMemory = $this->_profiler->getMemory();
	}
	
	protected function getTime(){
		return $this->_neededTime;
	}
	
	protected function getMemory(){
		return $this->_neededMemory;
	}
}
?>