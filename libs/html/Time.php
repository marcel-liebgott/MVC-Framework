<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Html_Time extends FW_Html_Element{
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
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 */
	public function __construct($name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($name, $id, $class, $value, $default);

		$this->setValue($value);
		$this->setAutocomplete(false);
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setValue($value){
		if(FW_Validate::isInteger($value)){
			$this->value = $value;
		}
	}

	/**
	 * return the value of this element
	 *
	 * @access public
	 * @return string
	 */
	public final function getValue(){
		return $this->value;
	}

	/**
	 * set min property of this element
	 *
	 * @access public
	 * @param int
	 */
	public final function setMin($min){
		if(FW_Validate::isInteger($min)){
			$this->setvalue($min);
			$this->min = $min;
		}
	}

	/**
	 * get min
	 *
	 * @access public
	 * @return int
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