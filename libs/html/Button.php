<?php
/**
 * with this class you could be generate an html textbox element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_Button extends FW_Abstract_HtmlElement{
	/**
	 * value of this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $value;

	/**
	 * button type
	 *
	 * @access private
	 * @var string
	 */
	private $type;

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $id
	 * @param string $class
	 * @param string $value
	 * @param string $default
	 */
	public function __construct($id = null, $class = null, $value = null, $default = null){
		parent::__construct(null, $id, $class, $default);

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
	 * set button type
	 *
	 * @access public
	 * @param string $type
	 */
	public final function setType($type){
		$this->type = $type;
	}

	/**
	 * get button type
	 *
	 * @access public
	 * @return string
	 */
	public final function getType(){
		return $this->type;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<button type="' .- $this->type . '"';
		$html .= $this->generateBasicProperty();
		$html .= '>';
		$html .= $this->value;
		$html .='</button>';

		return $html;
	}
}
?>
