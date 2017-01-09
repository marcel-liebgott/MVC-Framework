<?php
/**
 * this class work with much of string function in your selected encoding
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */ 
final class FW_String{
	/**
	 * encoding
	 *
	 * @access private
	 * @var string
	 */
	private static $encoding;

	/**
	 * do you want to use mb_* function
	 *
	 * @access private
	 * @var boolean
	 */
	private static $use_mb;
	
	/**
	 * string value
	 * 
	 * @access private
	 * @var string
	 */
	private $value;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @param string $string
	 * @since 1.01
	 */
	public function __construct($string = ''){
		if($string != null && $string != ''){
			$this->value = $string;
		}
	}
	
	/**
	 * method to define the output stream of this object
	 * 
	 * @access public
	 * @since
	 * @return String
	 */
	public function __toString(){
		return $this->value;
	}

	/**
	 * set the boolean value for using mb function
	 *
	 * @access public
	 * @param boolean $mb
	 */
	public static function setMbUsing($mb){
		self::$use_mb = $mb;
	}

	/**
	 * return the choice of using mb_* functions
	 *
	 * @access public
	 * @return boolean
	 */
	public static function isMbUsing(){
		return self::$use_mb;
	}

	/**
	 * set encoding if you use mb_* function - see FW_String::$use_mb
	 *
	 * @access public
	 * @param string $encoding
	 */
	public static function setEncoding($encoding = 'UTF-8'){
		if(self::$use_mb){
			self::$encoding = $encoding;
			mb_internal_encoding($encoding);
		}
	}

	/**
	 * return the character encoding if mb_* fucntion used
	 *
	 * @access public
	 * @return string
	 */
	public static function getEncoding(){
		if(self::$use_mb){
			return self::$encoding;
		}
	}

	/**
	 * set current language
	 *
	 * @access public
	 * @param string $string
	 */
	public static function setLanguage($string){
		if(self::$use_mb){
			mb_language($string);
		}
	}

	/**
	 * get the current language
	 *
	 * @access public
	 * @return string
	 */
	public static function getLanguage(){
		if(self::$use_mb){
			return mb_language();
		}
	}

	/**
	 * get the substring 
	 *
	 * @access public
	 * @param string $string
	 * @param int $startPos
	 * @param int $lenght
	 * @return string
	 */
	public static function substr($string, $startPos, $lenght = 0){
		if(self::$use_mb){
			if($lenght > 0){
				return mb_substr($string, $startPos, $lenght);
			}else{
				return mb_substr($string, $startPos);
			}
		}else{
			if($lenght > 0){
				return substr($string, $startPos, $lenght);
			}else{
				return substr($string, $startPos);
			}
		}
	}

	/**
	 * return the lenght of an string
	 *
	 * @access public
	 * @param string $string
	 * @return int
	 */
	public static function strlen($string){
		if(self::$use_mb){
			return mb_strlen($string);
		}else{
			return strlen($string);
		}
	}

	/**
	 * make a string lowercase
	 *
	 * @access public 
	 * @param string $string
	 * @return string
	 */
	public static function strtolower($string){
		if(self::$use_mb){
			return mb_strtolower($string);
		}else{
			return strtolower($string);
		}
	}

	/**
	 * make a string uppercase
	 *
	 * @access public
	 * @param string $string
	 * @return string
	 */
	public static function strtoupper($string){
		if(self::$use_mb){
			return mb_strtoupper($string);
		}else{
			return strtoupper($string);
		}
	}

	/**
	 * find position of first occurrence of needle in haystack
	 *
	 * @access public
	 * @param string $haystack
	 * @param string $needle
	 * @param int $offset
	 * @return int
	 */
	public static function strpos($haystack, $needle, $offset = 0){
		if(self::$use_mb){
			return mb_strpos($haystack, $needle, $offset);
		}else{
			return strpos($haystack, $needle, $offset);
		}
	}

	/**
	 * count the number of substring occurrences
	 *
	 * @access public
	 * @param string $haystack
	 * @param string $needle
	 * @return int
	 */
	public static function substrCount($haystack, $needle){
		if(self::$use_mb){
			return mb_substr_count($haystack, $needle);
		}else{
			return substr_count($haystack, $needle);
		}
	}

	/**
	 * send mail
	 *
	 * @access public
	 * @param string $to
	 * @param string $subject
	 * @param string $message
	 * @param string $additional_headers
	 * @param string $additional_parameters
	 * @return boolean
	 */
	public static function mail($to, $subject, $message, $additional_headers = '', $additional_parameters = ''){
		if(self::$use_mb){
			return mb_send_mail($to, $subject, $message, $additional_headers, $additional_parameters);
		}else{
			return mail($to, $subject, $message, $additional_headers, $additional_parameters);
		}
	}
}
?>
