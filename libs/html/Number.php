<?php
/**
 * with this class you could be generate an html number element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Html_Number extends FW_Abstract_HtmlElement{
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
	 * @param string $type
	 * @param string $name
	 * @param string $id
	 * @param string $class
	 * @param int $value
	 * @param string $default
	 */
	public function __construct($type, $name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($name, $id, $class, $default);

		if($value === null){
			$this->setValue($this->getMin());
		}
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param int $value 
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
	 * @return int
	 */
	public final function getValue(){
		return $this->value;
	}

	/**
	 * set min property of this element
	 *
	 * @access public
	 * @param int $min
	 */
	public final function setMin($min){
		if(FW_Validate::isInteger($min)){
			$this->setValue($min);
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
	 * @param int $max
	 */
	public final function setMax($max){
		if(FW_Validate::isInteger($max)){
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
	 * @param int $step
	 */
	public final function setStep($step){
		if(FW_Validate::isInteger($step)){
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
