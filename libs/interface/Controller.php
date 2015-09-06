<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * basic class to define controller
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.20
 */
interface FW_Interface_Controller{
	/**
	 * add a pre filter
	 * 
	 * @access public
	 * @since 1.20
	 * @param FW_Interface_Filter $filter
	 */
	public function addPreFilter(FW_Interface_Filter $filter);

	/**
	 * add a post filter
	 * 
	 * @access public
	 * @since 1.20
	 * @param FW_Interface_Filter $filter
	 */
	public function addPostFilter(FW_Interface_Filter $filter);

	/**
	 * handle the current request
	 * 
	 * @access public
	 * @since 1.20
	 * @param FW_Request $request
	 * @param FW_Response $response
	 */
	public function handleRequest(FW_Request $request, FW_Response $response);

	/**
	 * load the model from the current controller
	 * 
	 * @access public
	 * @since 1.20
	 * @param unknown $name
	 * @param unknown $modelPath
	 */
	public function loadModel($name, $modelPath);
}
?>
