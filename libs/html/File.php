<?php
/**
 * with this class you could be generate an html textbox element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_File extends FW_Abstract_HtmlElement{
	/**
	 * placeholder of this element
	 *
	 * @access private
	 * @var string
	 */
	private $placeholder = null;

	/**
	 * maxlenght of the value
	 *
	 * @access private
	 * @var int
	 */
	private $maxlenght;

	/**
	 * value of this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $value;

	/**
	 * property to upload more than one file
	 *
	 * @access private
	 * @var boolean
	 */
	private $multiple = false;

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
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param string $value
	 */
	public final function setValue($value){
		if(FW_Validate::isMixed($value)){
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
	 * set the placeholder property of this element
	 *
	 * @access public
	 * @param string $placeholder
	 */
	public final function setPlaceholder($placeholder){
		if(FW_Validate::isMixed($placeholder)){
			$this->placeholder = $placeholder;
		}
	}

	/**
	 * get placeholder
	 *
	 * @access public
	 * @return string
	 */
	public final function getPlaceholder(){
		return $this->placeholder;
	}

	/**
	 * set required property of this element
	 *
	 * @access public
	 * @param boolean $required
	 */
	public final function setRequired($required){
		if(FW_Validate::isBool($required)){
			$this->required = $required;
		}
	}

	/**
	 * set maxlenght property of this element
	 *
	 * @access public
	 * @param int $len
	 */
	public final function setMaxlenght($len){
		if(FW_Validate::isInteger($len) && $len < 0){
			$this->maxlenght = $len;
		}
	}

	/**
	 * get maxlenght
	 *
	 * @access public
	 * @return int
	 */
	public final function getMaxlenght(){
		return $this->maxlenght;
	}

	/**
	 * set multiple property of file input
	 *
	 * @access public
	 * @param boolean $multiple
	 */
	public final function setMultiple($multiple){
		if(FW_Validate::isBool($multiple)){
			$this->multiple = $multiple;
		}
	}

	/**
	 * get multiple
	 *
	 * @access public
	 * @return boolean
	 */
	public final function isMultiple(){
		return $this->multiple;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<input type="file"';
		$html .= $this->generateBasicProperty();

		if($this->multiple){
			$html .= $html .= ' multiple="multiple"';
		}

		$html .='/>';

		return $html;
	}
}
?>
