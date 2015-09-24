<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
<<<<<<< HEAD
 * basic class to define controller
 *
=======
 * interface for all controller types
 * 
>>>>>>> master
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.20
 */
interface FW_Interface_Controller{
	/**
<<<<<<< HEAD
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
=======
	 * default method after controller creation
	 * 
	 * @access pblic
	 * @since 1.20
	 */
	public function index();
}
?>
>>>>>>> master
