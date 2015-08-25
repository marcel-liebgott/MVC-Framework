<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * with this class you could be generate an html search element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 */
final class FW_Html_Search extends FW_Abstract_HtmlElement{
	/**
	 * placeholder property of this element
	 *
	 * @access private
	 * @var string
	 */
	private $placeholder;
	
	/**
	 * constructor
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 */
	public function __construct($name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($name, $id, $class, $value, $default);

		$this->setAutocomplete(false);
	}

	/**
	 * set placeholder of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setPlaceholder($placeholder){
		if(FW_Validate::isString($placeholder)){
			$this->placeholder = $placeholder;
		}
	}

	/**
	 * return the placeholder of this element
	 *
	 * @access public
	 * @return string
	 */
	public final function getPlaceholder(){
		return $this->placeholder;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<input type="search"';

		$html .= $this->generateBasicProperty();

		$html .= ' placeholder="' . $this->placeholder . '"';

		$html .= ' />';

		return $html;
	}
}
?>