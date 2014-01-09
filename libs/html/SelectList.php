<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Html_SelectList extends FW_Html_List{
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
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 */
	public function __construct($name, $id = null, $class = null, $value = null, $default = null){
		parent::__construct($name, $id, $class, $value, $default);
	}

	/**
	 * set multiple property of this element
	 *
	 * @access public
	 * @param boolean
	 */
	public final function setMultiple($multiple){
		if($this->validate->isBool($multiple)){
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
	 * @param int
	 */
	public final function setSize($size){
		if($this->validate->isInteger($size)){
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
	 * @param string
	 */
	public final function setSelected($selected){
		if($this->validate->isMixed($selected)){
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