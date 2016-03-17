<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * with this class you could be generate an html time element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_Time extends FW_Abstract_HtmlElement{
	/**
	 * min property of this element
	 *
	 * @access private
	 * @var date
	 */
	private $min;

	/**
	 * max property of this element
	 *
	 * @access private
	 * @var date
	 */
	private $max;

	/**
	 * value of this element
	 *
	 * @access private
	 * @var date
	 */
	private $value;

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $name
	 * @param string $id
	 * @param string $class
	 * @param date $value
	 * @param string $default
	 */
	public function __construct($name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($name, $id, $class, $default);

		$this->setValue($value);
		$this->setAutocomplete(false);
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param date $value
	 */
	public final function setValue($value){
		$this->value = $value;
	}

	/**
	 * return the value of this element
	 *
	 * @access public
	 * @return date
	 */
	public final function getValue(){
		return $this->value;
	}

	/**
	 * set min property of this element
	 *
	 * @access public
	 * @param date $min
	 */
	public final function setMin($min){
		$this->setValue($min);
		$this->min = $min;
	}

	/**
	 * get min
	 *
	 * @access public
	 * @return date
	 */
	public final function getMin(){
		return $this->min;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<input type="time"';

		$html .= $this->generateBasicProperty();

		if(!empty($this->min)){
			$html .= ' min="' . $this->min . '"';
		}

		if(!empty($this->max)){
			$html .= ' max="' . $this->max . '"';
		}

		$html .= ' />';

		return $html;
	}

}
?>