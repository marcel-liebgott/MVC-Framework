<?php
/**
 * this class representate a page section
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @package libs.html
 * @since 1.01
 */
class FW_Html_Section extends FW_Object{
	/**
	 * @access private
	 * @var int
	 */
	private $sectionId;
	
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
	public function setTemplate($template){
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
