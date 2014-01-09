<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Html_DatetimeLocal extends FW_Html_Element{
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
	 * a past date enable
	 *
	 * @access private
	 * @var boolean
	 */
	private $pastValueEnable = false;

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
	 * set the property if a past value is enable
	 *
	 * @access public
	 * @param boolean
	 */
	public final function setPastDateEnable($enable){
		if($this->validate->isBool($enable)){
			$this->pastValueEnable = $enable;
		}
	}

	/**
	 * get the property of enable value with is in the history
	 *
	 * @access public
	 * @return boolean
	 */
	public function getPastDateEnable(){
		return $this->pastValueEnable;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<input type="datetime-local"';

		$html .= $this->generateBasicProperty();

		$min = $this->pastValueEnable ? $this->min : date('d.m.Y H:m');

		$html .= ' min="' . $min . '"';

		if(!empty($this->max)){
			$html .= ' max="' . $this->max . '"';
		}

		$html .= ' />';

		return $html;
	}
}
?>