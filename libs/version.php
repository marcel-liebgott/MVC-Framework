<?php
/**
 * some version information
 * Hint:
 * 	Please don't change anythink here
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 * 
 * @codeCoverageIgnore
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
	 * @var string
	 * @since 1.01
	 */
	private static $_version = "1";
	
	/**
	 * current major
	 * 
	 * @access private
	 * @static
	 * @var string
	 * @since 1.01
	 */
	private static $_major = "01";
	
	/**
	 * current build
	 * 
	 * @access private
	 * @static
	 * @var string
	 * @since 1.01
	 */
	private static $_build = "014";
	
	/**
	 * current version state
	 * possible states are 'alpha', 'beta', 'release_candidate', 'release'
	 * 
	 * @access private
	 * @static
	 * @var string
	 * @since 1.01
	 */
	private static $_state = FW_Version::BETA;
	
	/**
	 * get the current version
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getVersion() : string{
		return FW_Version::$_version;
	}
	
	/**
	 * get current major version
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getMajor() : string{
		return FW_Version::$_major;
	}
	
	/**
	 * get current build version
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getBuild() : string{
		return FW_Version::$_build;
	}
	
	/**
	 * get current version state
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getVersionState() : string{
		return FW_Version::$_state;
	}
	
	/**
	 * get the current version as id string
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getVersionId() : string{
		return FW_Version::getVersion() . FW_Version::getMajor();
	}
	
	/**
	 * get the current version with build statement as string
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getVersionFullId() : string{
		return FW_Version::getVersion() . FW_Version::getMajor() . FW_Version::$_build;
	}
	
	/**
	 * get current version as full string
	 * 
	 * @access public
	 * @static
	 * @since 1.01
	 * @return string
	 */
	public static function getFull() : string{
		return FW_Version::$_version . "." . FW_Version::$_major . "." . FW_Version::$_build;
	}
}
?>
