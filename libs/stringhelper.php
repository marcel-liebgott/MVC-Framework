<?php
/**
 * this class will be help with many function for working with strings
 * they will be checked or manipulated it
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
final class FW_Stringhelper{
	/**
	 * return a cleaned date value in format DD.MM.YYY
	 * 
	 * @access public
	 * @since 1.00
	 * @param string $date
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
	 * @since 1.00
	 * @param string $mail
	 * @return boolean
	 */
	public static function isValidMail($mail){
		return preg_match('/^[a-z0-9!#$%&*+-=?^_`{|}~]+(\.[a-z0-9!#$%&*+-=?^_`{|}~]+)*@([-a-z0-9]+\.)+([a-z]{2,3})$/i', $mail);
	}

	/**
	 * checked if the url is valid
	 *
	 * @access public
	 * @since 1.00
	 * @param string $url
	 * @return boolean
	 */
	public static function isValidUrl($url){
		// has url an protocol (http or https)
		if(FW_String::substr($url, 0, 7) !== 'http://' || FW_String::substr($url, 0, 8) !== 'https://' || FW_String::substr($url, 0, 6) !== "ftp://"){
			$url = 'http://' . $url;
		}

		if(filter_var($url, FILTER_VALIDATE_URL)){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * get the size in a human format
	 *
	 * @access public
	 * @since 1.00
	 * @param float $size
	 * @param int $round
	 * @return string
	 */
	public static function convertSize($size, $round = 3){
		$base = log($size) / log(1024);
		$sizes = array('B', 'kB', 'MB', 'GB', 'TB');

		return round(pow(1024, (int)($base - floor($base))), $round) . $sizes[floor($base)];
	}
}
?>
