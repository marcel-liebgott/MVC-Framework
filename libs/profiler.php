<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed");
}

/**
 * with this class you could measure the time and memory usage
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
final class FW_Profiler{
	/**
	 * start time of profile
	 *
	 * @access private
	 * @var int
	 */
	private $start_time;

	/**
	 * start memory of profile
	 * 
	 * @access private
	 * @var int
	 */
	private $start_mem;

	/**
	 * constructer
	 * 
	 * @access public
	 */
	public function __construct(){
		$this->start_time = 0;
		$this->start_mem = 0;
	}

	/**
	 * start profiling
	 *
	 * @access public
	 * @since 1.00
	 */
	public function start(){
		$this->start_time = explode(' ', microtime());
		$this->start_mem = FW_Memory::getCurrentMemory();
	}

	/**
	 * get needed time between begin until now
	 * 
	 * @access public
	 * @since 1.00
	 * @return float
	 */
	public function getTime(){
		$end_time = explode(' ', microtime());

		$diff_time = $end_time[0] - $this->start_time[0];

		return round($diff_time, 5);
	}

	/**
	 * get needed memory between begin until now
	 *
	 * @access public
	 * @since 1.00
	 * @return string
	 */
	public function getMemory(){
		$end_mem = FW_Memory::getCurrentMemory();

		$diff_mem = $end_mem - $this->start_mem;

		$size = FW_Stringhelper::convertSize($diff_mem, 3);

		return $size;
	}
}
?>
