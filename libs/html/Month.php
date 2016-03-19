<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * with this class you could be generate an html week element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_Month extends FW_Abstract_HtmlElement{
		/**
	 * min property of this element
	 *
	 * @access private
	 * @var string
	 */
	private $min;

	/**
	 * max property of this element
	 *
	 * @access private
	 * @var string
	 */
	private $max;

	/**
	 * value of this element
	 *
	 * @access private
	 * @var string
	 */
	private $value;

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $name
	 * @param string $id
	 * @param string $class
	 * @param string $value
	 * @param string $default
	 */
	public function __construct($name, $id = null, $class = null, $value = null, $default = null){
		if($value !== null){
			$value = null;
		}

		parent::__construct($name, $id, $class, $default);

		$this->setAutocomplete(false);
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param int $month
	 * @param int $year
	 */
	public final function setValue($month, $year){
		if(FW_Validate::isInteger($month) && FW_Validate::isInteger($year)){
			$this->value = $year . '-' . $month;
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
	 * @param int $month
	 * @param int $year
	 */
	public final function setMin($month, $year){
		if(FW_Validate::isInteger($month) && FW_Validate::isInteger($year)){
			$this->setValue($month, $year);
			$this->min = $year . '-' . $month;
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
	 * @param int $month
	 * @param int $year
	 */
	public final function setMax($month, $year){
		if(FW_Validate::isInteger($month) && FW_Validate::isInteger($year)){
			$this->max = $year . '-' . $month;
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