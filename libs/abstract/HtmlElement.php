<?php
/**
 * basic class for html input elements
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
abstract class FW_Abstract_HtmlElement{
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
	 * @access protected
	 * @var boolean
	 */
	protected $required = false;

	/**
	 * autofocus this element
	 *
	 * @access private
	 * @var boolean
	 */
	private $autofocus = false;

	/**
	 * autocomplete this element
	 *
	 * @access private
	 * @var boolean
	 */
	private $autocomplete = true;

	/**
	 * disable this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $disabled = null;

	/**
	 * pattern value of this element
	 *
	 * @access private
	 * @var mixed
	 */
	private $pattern = null;

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $name
	 * @param string $id
	 * @param string $class
	 * @param string $default
	 */
	public function __construct($name, $id = null, $class = null, $default = null){
		$this->setName($name);
		$this->setId($id);
		$this->setClass($class);
		$this->setDefault($default);
	}

	/**
	 * set name of this element
	 *
	 * @access public
	 * @param string $name
	 */
	public final function setName($name){
		if(FW_Validate::isMixed($name)){
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
	 * @param string $id
	 */
	public final function setId($id){
		if(FW_Validate::isString($id)){
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
	 * @param string $class
	 */
	public final function setClass($class){
		if(FW_Validate::isMixed($class)){
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
	 * @param string $default
	 */
	public final function setDefault($default){
		if(FW_Validate::isMixed($default)){
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
	 * @param string $key
	 * @param string $value
	 */
	public final function setStyle($key, $value){
		if(FW_Validate::isString($key) && FW_Validate::isString($value)){
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
	 * set autocomplete property of this element
	 *
	 * @access public
	 * @param boolean $complete
	 */
	public final function setAutocomplete($complete){
		if(FW_Validate::isBool($complete)){
			$this->autocomplete = $complete;
		}
	}

	/**
	 * get autocomplete
	 *
	 * @access public
	 * @return boolean
	 */
	public final function isAutocomplete(){
		return $this->autocomplete;
	}

	/**
	 * get required
	 *
	 * @access public
	 * @return boolean
	 */
	public final function isRequired(){
		return $this->required;
	}

	/**
	 * set autofocus property of this element
	 *
	 * @access public
	 * @param boolean $focus
	 */
	public final function setAutofocus($focus){
		if(FW_Validate::isBool($focus)){
			$this->autofocus = $focus;
		}
	}

	/**
	 * get autofocus
	 *
	 * @access public
	 * @return boolean
	 */
	public final function isAutofocus(){
		return $this->autofocus;
	}

	/**
	 * set disabled property of this element
	 * isn't the value of param empty, so we would be disabled this element
	 *
	 * @access public
	 * @param mixed $value
	 */
	public final function setDisabled($value){
		if(FW_Validate::isMixed($value)){
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
	 * set the pattern property of this element
	 *
	 * @access public
	 * @param mixed $pattern
	 */
	public final function setPattern($pattern){
		if(FW_Validate::isMixed($pattern)){
			$this->pattern = $pattern;
		}
	}

	/**
	 * get pattern
	 *
	 * @access public
	 * @return mixed
	 */
	public final function getPattern(){
		return $this->pattern;
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

		$html .= ' autocomplete="';
		if($this->autocomplete){
			$html .= 'on"';
		}else{
			$html .= 'off"';
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

		if(!empty($this->pattern)){
			$html .= ' pattern="' . $this->pattern . '"';
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
