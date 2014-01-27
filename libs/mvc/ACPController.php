<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * Administration Center Panel - Controller
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @since 1.00
 */
class FW_Mvc_ACPController extends FW_Mvc_Controller{
	/**
	 * constructor
	 *
	 * @access public
	 */
	public function __construct(){
		parent::__construct();

		$url = $this->request->getUrl();

		if(isset($url[1]) && !empty($url[1]) && FW_String::strtolower($url[1]) !== 'login'){
			$this->addPreFilter(new FW_Filter_loginFilter());

			$this->handleRequest($this->request, $this->response);
		}

		$this->view->addVariables(array(
			'modul' => isset($url[1]) ? $url[1] : ACP_DEFAULT_CTR
		));
	}
}
?>