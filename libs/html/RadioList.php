<?php
/**
 * with this class you could be generate a list of html radiobuttons - based on html5
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Html_RadioList extends FW_Abstract_HtmlList{
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
