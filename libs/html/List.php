<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

abstract class FW_Html_List{
	/**
	 * id of this element
	 * for css, javascript, jquery, ...
	 *
	 * @access private
	 * @var string
	 */
	private $id;

	/**
	 * name of this element
	 *
	 * @access private
	 * @var string
	 */
	private $name;

	/**
	 * style of this element
	 *
	 * @access private
	 * @var array
	 */
	private $style;

	/**
	 * class of this element
	 *
	 * @access private
	 * @var string
	 */
	private $class;

	/**
	 * default value of this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $default;

	/**
	 * if this element required
	 *
	 * @access private
	 * @var boolean
	 */
	private $required = false;

	/**
	 * autofocus this element
	 *
	 * @access private
	 * @var boolean
	 */
	private $autofocus = false;

	/**
	 * disable this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $disabled = null;

	/**
	 * validation
	 *
	 * @access protected
	 * @var FW_Validate
	 */
	protected $validate;

	/**
	 * all options of this list
	 *
	 * @access private
	 * @var array
	 */
	private $options = array();

	/**
	 * constructor
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 */
	public function __construct($name, $id = null, $class = null, $value = null, $default = null){
		$this->validate = new FW_Validate();

		$this->setName($name);
		$this->setId($id);
		$this->setClass($class);
		$this->setDefault($default);
	}

	/**
	 * set name of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setName($name){
		if($this->validate->isString($name)){
			$this->name = $name;
		}
	}

	/**
	 * return the name of this element
	 *
	 * @access public
	 * @return string
	 */
	public final function getName(){
		return $this->name;
	}

	/**
	 * set id of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setId($id){
		if($this->validate->isString($id)){
			$this->id = $id;
		}
	}

	/**
	 * return the id of this element
	 *
	 * @access public
	 * @return string
	 */
	public final function getId(){
		return $this->id;
	}

	/**
	 * set class of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setClass($class){
		if($this->validate->isString($class)){
			$this->class = $class;
		}
	}

	/**
	 * return the class of this element
	 *
	 * @access public
	 * @return string
	 */
	public final function getClass(){
		return $this->class;
	}

	/**
	 * set default of this element
	 *
	 * @access public
	 * @param string 
	 */
	public final function setDefault($default){
		if($this->validate->isString($default)){
			$this->default = $default;
		}
	}

	/**
	 * return the default of this element
	 *
	 * @access public
	 * @return string
	 */
	public final function getDefault(){
		return $this->default;
	}

	/**
	 * set style property of this element
	 *
	 * @access public
	 * @param string
	 * @param string 
	 */
	public final function setStyle($key, $value){
		if($this->validate->isString($key) && $this->validate->isString($value)){
			$this->style[$key] = $value;
		}
	}

	/**
	 * get style
	 *
	 * @access public
	 * @return array
	 */
	public final function getStyle(){
		return $this->style;
	}

	/**
	 * get required
	 *
	 * @access public
	 * @return boolean
	 */
	public final function getRequired(){
		return $this->required;
	}

	/**
	 * set autofocus property of this element
	 *
	 * @access public
	 * @param boolean
	 */
	public final function setAutofocus($focus){
		if($this->validate->isBool($focus)){
			$this->autofocus = $focus;
		}
	}

	/**
	 * get autofocus
	 *
	 * @access public
	 * @return boolean
	 */
	public final function getAutofocus(){
		return $this->autofocus;
	}

	/**
	 * set disabled property of this element
	 * isn't the value of param empty, so we would be disabled this element
	 * disabled value="{@param value}"
	 *
	 * @access public
	 * @param mixed
	 */
	public final function setDisabled($value){
		if($this->validate->isMixed($value)){
			$this->disabled = $value;
		}
	}

	/**
	 * return disabled
	 *
	 * @access public
	 * @return mixed
	 */
	public final function getDisabled(){
		return $this->disabled;
	}

	/**
	 * set all options of this list
	 *
	 * @access public
	 * @param array
	 */
	public final function setOptions($options){
		if($this->validate->isArray($options)){
			$this->options = $options;
		}
	}

	/**
	 * get all options of this list
	 *
	 * @access public
	 * @return arrray
	 */
	public function getOptions(){
		return $this->options;
	}

	/**
	 * add a new list option item
	 *
	 * @access public
	 * @param string
	 * @param string
	 */
	public final function addOption($value, $desc){
		if($this->validate->isMixed($value) && $this->validate->isMixed($desc)){
			$this->options[$value] = $desc;
		}
	}

	/**
	 * generate the html code of this element
	 *
	 * @access public
	 * @return mixed
	 */
	public abstract function toString();

	/**
	 * generate basic property of this element
	 *
	 * @access protected
	 * @return mixed
	 */
	protected function generateBasicProperty(){
		$html = ' name="' . $this->name . '"';

		if(!empty($this->id)){
			$html .= ' id="' . $this->id . '"';
		}

		if(!empty($this->class)){
			$html .= ' class="' . $this->class . '"';
		}

		if(count($this->style) > 0){
			$html .= ' style="';

			foreach($this->style as $key => $value){
				$html .= $key . ': ' . $value . '; ';
			}

			$html .= '"';
		}

		if(!empty($this->disabled)){
			$html .= ' disabled value="' . $this->disabled . '"';
		}

		if($this->required){
			$html .= ' required';
		}

		$html .= ' autofocus="';
		if($this->autofocus){
			$html .= 'on"';
		}else{
			$html .= 'off"';
		}

		return $html;
	}
}
?>