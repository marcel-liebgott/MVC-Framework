<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * with this class you could be generate an html formular - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 */
final class FW_Html_Formular extends FW_Abstract_HtmlElement{
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
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '';

		return $html;
	}
}
?>