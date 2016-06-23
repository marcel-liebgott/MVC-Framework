<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * get all input values an make it secure
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @since 1.00
 */
class FW_Security{
	/**
	 * check given input for xss attack
	 *
	 * @access public
	 * @static
	 * @param string $data
	 * @return string
	 */
	public static function checkXSS($data){
		$data = htmlspecialchars($data);

		if(phpversion() < 5.4){
			$data = htmlentities($data, ENT_HTML5, "UTF-8");
		}else{
			$data = htmlentities($data);
		}

		return $data;
	}

	/**
	 * clean the url
	 *
	 * @access public
	 * @static
	 * @param string $url
	 * @return string
	 */
	public static function cleanUrl($url){
		$bad = array("&", "\"", "'", '\"', "\'", "<", ">", "(", ")", "*", "$");
		$good = array("&amp;", "", "", "", "", "", "", "", "", "", "");

		$url = str_ireplace($bad, $good, $url);

		return $url;
	}

	/**
	 * remove all without enabled HTML & PHP-Tags
	 *
	 * @access public
	 * @static
	 * @param string $data
	 * @param string $enable
	 * @return string
	 */
	public static function striptags($data, $enable = null){
		$data = strip_tags($data, $enable);

		return $data;
	}
}
?>
