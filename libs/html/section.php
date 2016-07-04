<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed");
}

/**
 * this class representate a page section
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @package libs.html
 * @since 1.01
 */
class FW_Html_Section{
	/**
	 * @access private
	 * @var int
	 */
	private $id;
	
	/**
	 * @access private
	 * @var string
	 */
	private $template = "";
	
	/**
	 * constructor
	 *
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * section template
	 *
	 * @access public
	 * @param string $template
	 */
	public function setTemplate(String $template){
		$this->template = $template;
	}
	
	/**
	 * return the section template
	 *
	 * @access public
	 * @return string
	 */
	public function getTemplate(){
		return $this->template;
	}
}
?>
