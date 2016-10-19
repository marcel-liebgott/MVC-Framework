<?php
/**
 * with this class you could be generate an html textarea - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_Textarea extends FW_Abstract_HtmlElement{
	/**
	 * placeholder of this element
	 *
	 * @access private
	 * @var string
	 */
	private $placeholder = null;

	/**
	 * value of this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $value;

	/**
	 * css property to resize textarea vertical
	 *
	 * @access private
	 * @var boolean
	 */
	private $verticalResizeable = true;

	/**
	 * css property to resize textarea horizontal
	 *
	 * @access private
	 * @var boolean
	 */
	private $horizontalResizeable = true;

	/**
	 * cols property of this element
	 *
	 * @access private
	 * @var int
	 */
	private $cols = 45;

	/**
	 * rows property of this element
	 *
	 * @access private
	 * @var int
	 */
	private $rows = 10;

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $type
	 * @param string $name
	 * @param string $id
	 * @param string $class
	 * @param string $value
	 * @param string $default
	 */
	public function __construct($type, $name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($name, $id, $class, $default);

		$this->setValue($value);
	}

	/**
	 * set cols of this element
	 *
	 * @access public
	 * @param int $cols
	 */
	public final function setCols($cols){
		if(FW_Validate::isInteger($cols)){
			$this->cols = $cols;
		}
	}

	/**
	 * get cols of this element
	 *
	 * @access public
	 * @return int
	 */
	public final function getCols(){
		return $this->cols;
	}

	/**
	 * set rows of this element
	 *
	 * @access public
	 * @param int $rows
	 */
	public final function setRows($rows){
		if(FW_Validate::isInteger($rows)){
			$this->rows = $rows;
		}
	}

	/**
	 * get cols of this element
	 *
	 * @access public
	 * @return int
	 */
	public final function getRows(){
		return $this->cols;
	}

	/**
	 * set value of this element
	 *
	 * @access public
	 * @param string $value
	 */
	public final function setValue($value){
		if(FW_Validate::isString($value)){
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
	 * set vertical resize css property
	 *
	 * @access public
	 * @param boolean $resizeable
	 */
	public final function setVerticalResizeable($resizeable){
		if(FW_Validate::isBool($resizeable)){
			$this->verticalResizeable = $resizeable;
		}
	}

	/**
	 * get vertical resize css property
	 *
	 * @access public
	 * @return boolean
	 */
	public final function isVerticalResizeable(){
		return $this->verticalResizeable;
	}

	/**
	 * set horizontal resize css property
	 *
	 * @access public
	 * @param boolean $resizeable
	 */
	public final function setHorizontalResizeable($resizeable){
		if(FW_Validate::isBool($resizeable)){
			$this->horizontalResizeable = $resizeable;
		}
	}

	/**
	 * get horizontal resize css property
	 *
	 * @access public
	 * @return boolean
	 */
	public final function isHorizontalResizeable(){
		return $this->horizontalResizeable;
	}

	/**
	 * set the placeholder property of this element
	 *
	 * @access public
	 * @param string $placeholder
	 */
	public final function setPlaceholder($placeholder){
		if(FW_Validate::isString($placeholder)){
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
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		if($this->verticalResizeable){
			$this->setStyle('resize', 'vertical');
		}

		if($this->horizontalResizeable){
			$this->setStyle('resize', 'horizontal');
		}

		if(!$this->horizontalResizeable && !$this->verticalResizeable){
			$this->setStyle('resize', 'none');
		}

		$html = '<textarea';
		$html .= ' cols="' . $this->cols . '"';
		$html .= ' rows="' . $this->rows . '"';

		$html .= $this->generateBasicProperty();

		if(!empty($this->placeholder)){
			$html .= ' placeholder="' . $this->placeholder . '"';
		}

		$html .='>';

		if(!empty($this->value)){
			$html .= $this->value;
		}

		$html .= '</textarea>';

		return $html;
	}
}
?>
