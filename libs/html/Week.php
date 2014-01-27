<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Html_Week extends FW_Html_Element{
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
		if($value !== null){
			$value = null;
		}

		parent::__construct($name, $id, $class, $value, $default);

		$this->setAutocomplete(false);
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param int
	 * @param int
	 */
	public final function setValue($week, $year){
		if(FW_Validate::isInteger($week) && FW_Validate::isInteger($year)){
			$this->value = $year . '-W' . $week;
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
	 * @param string
	 */
	public final function setMin($week, $year){
		if(FW_Validate::isInteger($week) && FW_Validate::isInteger($year)){
			$this->setValue($week, $year);
			$this->min = $year . '-W' . $week;
		}
	}

	/**
	 * get min
	 *
	 * @access public
	 * @return string
	 */
	public final function getMin(){
		return $this->min;
	}

	/**
	 * set max property of this element
	 *
	 * @access public
	 * @param int
	 * @param int
	 */
	public final function setMax($week, $year){
		if(FW_Validate::isInteger($week) && FW_Validate::isInteger($year)){
			$this->max = $year . '-W' . $week;
		}
	}

	/**
	 * get max
	 *
	 * @access public
	 * @return string
	 */
	public final function getMax(){
		return $this->max;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<input type="week"';

		$html .= $this->generateBasicProperty();

		if(!empty($this->min)){
			$html .= ' min="' . $this->min . '"';
		}

		if(!empty($this->max)){
			$html .= ' max="' . $this->max . '"';
		}

		if(!empty($this->value)){
			$html .= ' value="' . $this->value . '"';
		}

		$html .= ' />';

		return $html;
	}
}
?>