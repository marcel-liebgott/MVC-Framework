<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * some version information
 * Hint:
 * 	Please do not somethink in this class
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.02
 */
final class FW_Version{
	/**
	 * all provided version states
	 */
	const ALPHA = "alpha";
	const BETA = "beta";
	const RELEASE_CANDIDATE = "Release Candidate";
	const RELEASED = "Released";
	
	/**
	 * current version
	 * 
	 * @access private
	 * @static
	 * @var String
	 */
	private static $_version = "1";
	
	/**
	 * current major
	 * 
	 * @access private
	 * @static
	 * @var String
	 */
	private static $_major = "02";
	
	/**
	 * current build
	 * 
	 * @access private
	 * @static
	 * @var String
	 */
	private static $_build = "010";
	
	/**
	 * current version state
	 * possible states are 'alpha', 'beta', 'release_candidate', 'release'
	 * 
	 * @access private
	 * @static
	 * @var String
	 */
	private static $_state = FW_Version::BETA;
	
	/**
	 * get the current version
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getVersion(){
		return FW_Version::$_version;
	}
	
	/**
	 * get current major version
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getMajor(){
		return FW_Version::$_major;
	}
	
	/**
	 * get current build version
	 * 
	 * @access püublic
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getBuild(){
		return FW_Version::$_build;
	}
	
	/**
	 * get current version state
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getVersionState(){
		return FW_Version::$_state;
	}
	
	/**
	 * get the current version as id string
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getVersionId(){
		return FW_Version::getVersion() . FW_Version::getMajor();
	}
	
	/**
	 * get the current version with build statement as string
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getVersionFullId(){
		return FW_Version::getVersion() . FW_Version::getMajor() . FW_Version::$_build;
	}
	
	/**
	 * get current version as full string
	 * 
	 * @access public
	 * @static
	 * @since 1.02
	 * @return String
	 */
	public static function getFull(){
		return FW_Version::$_version . "." . FW_Version::$_major;
	}
}
?>
