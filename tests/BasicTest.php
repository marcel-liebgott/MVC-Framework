<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * interface for a basic test
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
interface FW_Test_BasicTest{
	/**
	 * start current test
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function run();
	
	/**
	 * return the result
	 * 
	 * @access public
	 * @since 1.01
	 * @return array
	 */
	public function getResult();
	
	/**
	 * print the result of the current test
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function printResult();
}
?>