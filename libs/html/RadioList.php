<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Html_RadioList extends FW_Html_List{
	/**
	 * delimiter to display each item
	 *
	 * @access private
	 * @var sting
	 */
	private $delimiter = '<br>';

	/**
	 * checked item of this list of elements
	 *
	 * @access private
	 * @var mixed
	 */
	private $checked;

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
	 * set delimiter
	 *
	 * @access public
	 * @param string
	 */
	public final function setDeletimiter($delimiter){
		if($this->validate->isMixed($delimiter)){
			$this->delimiter = $delimiter;
		}
	}

	/**
	 * get delimiter
	 *
	 * @access public
	 * @return string
	 */
	public final function getDelimiter(){
		return $this->delimiter;
	}

	/**
	 * set checked
	 *
	 * @access public
	 * @param string
	 */
	public final function setChecked($checked){
		if($this->validate->isMixed($checked)){
			$this->checked = $checked;
		}
	}

	/**
	 * get checked
	 *
	 * @access public
	 * @return mixed
	 */
	public final function getChecked(){
		return $this->checked;
	}

	/**
	 * genrate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public function toString(){
		$html = null;

		foreach($this->getOptions() as $value => $desc){
			$html .= '<input type="radio"';

			$html .= $this->generateBasicProperty();

			$html .= ' value="' . $value . '"';

			if(!empty($this->checked) && $this->checked === $value){
				$html .= ' checked="checked"';
			}

			$html .= '> ';

			$html .= $desc;

			$html .= $this->delimiter;
		}

		return $html;
	}
}
?>