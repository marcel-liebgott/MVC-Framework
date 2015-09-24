<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * locale class for some country specific properties
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.02
 */
final class FW_Locale{
	// Germany
	public static $de_de_locale		= "de_DE";
	public static $de_de_name 		= "Deutschland";
	public static $de_de_time 		= "H:m";
	public static $de_de_date 		= "d.m.Y";
	public static $de_de_full 		= "d.m.Y H:m";
	
	// United Kingdom
	public static $en_gb_locale		= "en_GB";
	public static $en_gb_name 		= "United Kingdom";
	public static $en_gb_time 		= "H:m";
	public static $en_gb_date 		= "Y/m/d";
	public static $en_gb_full		= "";
	
	// United States
	public static $en_us_locale 	= "en_US";
	public static $en_us_name 		= "United States";
	public static $en_us_time		= "H:s A";
	public static $en_us_date		= "m/d/Y";
	public static $en_us_full		= "m/d/Y H:m A";
}
?>