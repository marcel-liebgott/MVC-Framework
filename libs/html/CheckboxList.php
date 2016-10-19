<?php
/**
 * with this class you could be generate an html list of checkboxes - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_CheckboxList extends FW_Abstract_HtmlList{
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
	 * @var array
	 */
	private $checked = array();

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
	 * set delimiter
	 *
	 * @access public
	 * @param string $delimiter
	 */
	public final function setDeletimiter($delimiter){
		if(FW_Validate::isMixed($delimiter)){
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
	 * @param string $checked
	 */
	public final function setChecked($checked){
		if(FW_Validate::isMixed($checked)){
			$this->checked[$checked];
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
			$html .= '<input type="checkbox"';

			$html .= $this->generateBasicProperty();

			$html .= ' value="' . $value . '"';

			if(!empty($this->checked) && in_array($value, $this->checked)){
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
