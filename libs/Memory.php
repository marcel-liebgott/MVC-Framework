<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * with this class u could get the information about the PHP memory
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 */
final class FW_Memory{
	/**
	 * return current allocated PHP memory 
	 *
	 * @access public
	 * @return int
	 */
	public static function getCurrentMemory(){
		return memory_get_usage();
	}

	/**
	 * return the limit of PHP memory
	 *
	 * @access public
	 * @return int
	 */
	public static function getMemoryLimit(){
		return ini_get('memory_limit');
	}
}
?>