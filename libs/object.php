<?php
/**
 * basic class to save some framework specifiv properties
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @package libs
 * @since 1.01
 */
abstract class FW_Object{
	/**
	 * @access private
	 * @static
	 * @var int
	 */
	private static $tmp_id = 1;
	
	/**
	 * @access protected
	 * @var int
	 */
	protected $id;
	
	protected function __construct(){
		$this->id = self::$tmp_id++;
	}
	
	/**
	 * get the object id
	 *
	 * @access public
	 * @final
	 * @return int
	 */
	public final function getId(){
		return $this->id;
	}
}
?>
