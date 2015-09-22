<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * default error controller
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.02
 */
class FW_Front_error extends FW_Mvc_Controller_default implements FW_Interface_Controller{
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.02
	 */
	public function __construct(){
		parent::__construct();
		
		$this->view->addVariables(array(
				'headline' => true
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see FW_Interface_Controller::index()
	 */
	public function index(){
		$this->view->render('error/index');
	}
	
	/**
	 * access denied method - http status 403
	 * 
	 * @access public
	 * @since 1.02
	 */
	public function accessDenied(){
		$this->view->render('error/403');
	}
	
	
	/**
	 * requested file/method is not available - http status 404
	 * 
	 * @access public
	 * @since 1.02
	 */
	public function notFound(){
		$this->view->render('error/404');
	}
}
?>