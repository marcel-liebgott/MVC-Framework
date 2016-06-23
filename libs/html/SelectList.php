<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * with this class you could be generate a list of html dropdown element - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_SelectList extends FW_Abstract_HtmlList{
	/**
	 * multiple property of this element
	 *
	 * @access private
	 * @var boolean
	 */
	private $multiple = false;

	/**
	 * size property of this element
	 *
	 * @access private
	 * @var int
	 */
	private $size = 1;

	/**
	 * selected item of this list of elements
	 *
	 * @access private
	 * @var array
	 */
	private $selected = array();

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
	}

	/**
	 * set multiple property of this element
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
	public final function getMultiple(){
		return $this->multiple;
	}

	/**
	 * set size property of this element
	 *
	 * @access public
	 * @param int $size
	 */
	public final function setSize($size){
		if(FW_Validate::isInteger($size)){
			$this->size = $size;
		}
	}

	/**
	 * get size
	 *
	 * @access public
	 * @return int
	 */
	public final function getSize(){
		return $this->size;
	}

	/**
	 * set selected
	 *
	 * @access public
	 * @param string $selected
	 */
	public final function setSelected($selected){
		if(FW_Validate::isMixed($selected)){
			if($this->multiple){
				$this->selected[$selected];
			}elseif(!$this->multiple && count($this->selected) == 0){
				$this->selected[$selected];
			}
		}
	}

	/**
	 * get selected
	 *
	 * @access public
	 * @return mixed
	 */
	public final function getSelected(){
		return $this->selected;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = '<select';

		$html .= $this->generateBasicProperty();

		if($this->multiple){
			$html .= ' multiple';
		}

		$html .= ' size="' . $this->size . '"';

		$html .= '>';

		foreach($this->getOptions() as $value => $desc){
			$html .= '<option value="' . $value . '"';

			if(in_array($value, $this->selected) && !empty($this->selected)){
				$html .= ' selected="selected"';
			}

			$html .= '>' . $desc . '</option>';
		}

		$html .= '</select>';

		return $html;
	}
}
?>
