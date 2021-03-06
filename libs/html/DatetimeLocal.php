<?php
/**
 * with this class you could be generate an html datepicker - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_DatetimeLocal extends FW_Abstract_HtmlElement{
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
	 * @param string $name
	 * @param string $id
	 * @param string $class
	 * @param string $value
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
	 * @param string $value 
	 */
	public final function setValue($value){
		$this->value = $value;
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
	 * @param string $min
	 */
	public final function setMin($min){
		$this->setValue($min);
		$this->min = $min;
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
	 * @param string $max
	 */
	public final function setMax($max){
		$this->max = $max;
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
	 * set the property if a past value is enable
	 *
	 * @access public
	 * @param boolean $enable
	 */
	public final function setPastDateEnable($enable){
		if(FW_Validate::isBool($enable)){
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
