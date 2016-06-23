<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * random class to get random values
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.02
 */
final class FW_Random{
	/**
	 * return an int random
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @param int $min
	 * @param int $max
	 * @return int
	 */
	public static function getIntRandom($min = 0, $max = null){
		if($max === null){
			$max = getrandmax();
		}
		
		return rand($min, $max);
	}
	
	/**
	 * get a character random
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @param int $count
	 * @return String
	 */
	public static function getCharRandom($count = 1){
		$chars = [
			'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
		];
		
		shuffle($chars);
		
		$rand = '';
		
		foreach(array_rand(chars, $count) as $idx){
			$rand .= $chars[$idx];
		}
		
		return $rand;
	}
}
?>
