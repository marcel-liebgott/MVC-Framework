<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

class FW_Html_Number extends FW_Html_Element{
	/**
	 * min property of this element
	 *
	 * @access private
	 * @var int
	 */
	private $min = 0;

	/**
	 * max property of this element
	 *
	 * @access private
	 * @var int
	 */
	private $max = 100;

	/**
	 * step property of this element
	 *
	 * @access private
	 * @var int
	 */
	private $step = 10;

	/**
	 * value of this element
	 *
	 * @access private
	 * @var mixed
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
	public function __construct($type, $name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($type, $name, $id, $class, $value, $default);

		if($value == null){
			$this->setValue($this->getMin());
		}
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setValue($value){
		if($this->validate->isInteger($value)){
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
		if($this->validate->isInteger($min)){
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
	 * set max property of this element
	 *
	 * @access public
	 * @param int
	 */
	public final function setMax($max){
		if($this->validate->isInteger($max)){
			$this->max = $max;
		}
	}

	/**
	 * get max
	 *
	 * @access public
	 * @return int
	 */
	public final function getMax(){
		return $this->max;
	}

	/**
	 * set step property of this element
	 *
	 * @access public
	 * @param int
	 */
	public final function setStep($step){
		if($this->validate->isInteger($step)){
			$this->step = $step;
		}
	}

	/**
	 * get step
	 *
	 * @access public
	 * @return int
	 */
	public final function getStep(){
		return $this->step;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<input type="number"';

		$html .= $this->generateBasicProperty();

		$html .= ' min="' . $this->min . '"';
		$html .= ' max="' . $this->max . '"';
		$html .= ' step="' . $this->step . '"';
		$html .= ' value="' . $this->value . '"';

		$html .= ' />';

		return $html;
	}
}
?>