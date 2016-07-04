<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct script access allowed");
}

/**
 * this class representate a page
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @package libs.html
 * @since 1.01
 */
class FW_Html_Page extends FW_Object{
	/**
	 * @access private
	 * @var string
	 */
	private $template = "";
	
	/**
	 * @access private
	 * @var FW_Array
	 */
	private $sections = array();
	
	/**
	 * @access private
	 * @var FW_Mvc_View
	 */
	private $view = null;
	
	/**
	 * constructor
	 *
	 * @access public
	 */
	public function __construct(){
		parent::__construct();
		
		$this->array = new FW_Array();
	}
	
	/**
	 * page template
	 *
	 * @access public
	 * @param string $template
	 */
	public function setTemplate($template){
		$this->template = $template;
	}
	
	/**
	 * return the page template
	 *
	 * @access public
	 * @return string
	 */
	public function getTemplate(){
		return $this->template;
	}
	
	/**
	 * add a page section
	 *
	 * @access public
	 * @param FW_Html_Section $section
	 */
	public function addSection(FW_Html_Section $section){
		$this->sections->add($section);
	}
	
	/**
	 * return all page sections
	 *
	 * @access public
	 * @return FW_Array
	 */
	public function getSections(){
		return $this->sections;
	}
	
	/**
	 * set the view to make it posible to use template core functionality inside a page
	 *
	 * @access public
	 * @param FW_Mvc_View $view
	 */
	public function setView(FW_Mvc_View $view){
		$this->view = $view;
	}
	
	/**
	 * get the vie object of the page
	 *
	 * @access public
	 * @return FW_Mvc_View
	 */
	public function getView(){
		return $this->view;
	}
	
	/**
	 * render this page
	 *
	 * @access public
	 */
	public function render(){
		$this->view->render($this->template);
	}
}
?>
