<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * this class will be help with many function for working with strings
 * they will be checked or manipulated it
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 */
final class FW_Stringhelper{
	/**
	 * return a cleaned date value in format DD.MM.YYY
	 * 
	 * @access public
	 * @param string
	 * @return string
	 */
	public static function getCleanDate($date){
		if(preg_match('/\d{2}\.\d{2}\.\d{4}/', $date)){
			return $date;
		}

		return '';
	}

	/**
	 * checked if the e-mail adress is valid
	 *
	 * @access public
	 * @param string
	 * @return string
	 */
	public static function isValidMail($mail){
		if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
			return $mail;
		}else{
			return '';
		}
	}

	/**
	 * checked if the url is valid
	 *
	 * @access public
	 * @param string
	 * @return string
	 */
	public static function isValidUrl($url){
		// has url an protocol (http or https)
		if(FW_String::substr($url, 0, 7) !== 'http://' || FW_String::substr($url, 0, 8) !== 'https://' || FW_String::substr($url, 0, 6) !== "ftp://"){
			$url = 'http://' . $url;
		}

		if(filter_var($url, FILTER_VALIDATE_URL)){
			return $url;
		}else{
			return '';
		}
	}

	/**
	 * get the size in a human format
	 *
	 * @access public
	 * @param flaot
	 * @param int
	 * @return string
	 */
	public static function convertSize($size, $round = 3){
		$base = log($size) / log(1024);
		$sizes = array('B', 'kB', 'MB', 'GB', 'TB');

		return round(pow(1024, $base - floor($base)), $round) . $sizes[floor($base)];
	}
}
?>