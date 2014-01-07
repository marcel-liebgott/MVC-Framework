<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * this class work with much of string function in your selected encoding
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
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
	 * set the boolean value for using mb function
	 *
	 * @access public
	 * @param boolean
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
	public static function getMbUsing(){
		return self::$use_mb;
	}

	/**
	 * set encoding if you use mb_* function - see FW_String::$use_mb
	 *
	 * @access public
	 * @param string
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
	 * @param string
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
	 * @param string
	 * @param int
	 * @param int
	 * @return string
	 */
	public static function substr($string, $startPos, $lenght){
		if(self::$use_mb){
			if($lenght > 0){
				return mb_substr($string, $startPos, $length);
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
	 * @param string
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
	 * @param string
	 */
	public function strtolower($string){
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
	 * @param string
	 */
	public static function strtoupper($string){
		if(self::$use_mb){
			return 
		}
	}

	/**
	 * find position of first occurrence of needle in haystack
	 *
	 * @access public
	 * @param string
	 * @param string
	 * @param int
	 * @return string
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
	 * @param string
	 * @param string
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
	 * @param string
	 * @param string 
	 * @param string
	 * @param string
	 * @param string
	 * @return boolean
	 */
	public static function mail($to, $subject, $message, $additional_headers = '', $addidional_parameters = ''){
		if(self::$use_mb){
			return mb_send_mail($to, $subject, $message, $additional_headers, $addidional_parameters);
		}else{
			return mail($to, $subject, $message, $additional_headers, $addidional_parameters);
		}
	}
}
?>