<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * with this class you could measure the time and memory usage
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
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
	 */
	private $start_mem;

	/**
	 * constructer
	 */
	public function __construct(){
		$this->start_time = 0;
		$this->start_mem = 0;
	}

	/**
	 * start profiling
	 *
	 * @access public
	 */
	public function start(){
		$this->start_time = explode(' ', microtime());
		$this->start_mem = FW_Memory::getCurrentMemory();
	}

	/**
	 * get needed time between begin until now
	 * 
	 * @access public
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
	 * @return int
	 */
	public function getMemory(){
		$end_mem = FW_Memory::getCurrentMemory();

		$diff_mem = $end_mem - $this->start_mem;

		$size = FW_Stringhelper::convertSize($diff_mem, 3);

		return $size;
	}
}
?>