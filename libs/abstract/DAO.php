<?php
/**
 * basic class for all data access object
 *  
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
abstract class FW_Abstract_DAO extends FW_Singleton{
	/**
	 * database connection
	 * 
	 * @access protected
	 * @var FW_Database
	 */
	protected $db;
	
	/**
	 * constructor
	 * 
	 * @access protected
	 */
	public function __construct(){
		$this->db = FW_Registry::getInstance()->getDatabase();
	}
}
?>
