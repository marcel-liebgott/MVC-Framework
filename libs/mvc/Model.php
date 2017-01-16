<?php
/**
 * model class
 * 
 * @author marcel
 * @version 1.00
 * 
 * @codeCoverageIgnore
 */
class FW_Mvc_Model{
	/**
	 * registry
	 * 
	 * @access protected
	 * @var FW_Registry
	 */
    protected $registry;
    
    /**
     * database
     * 
     * @access protected
     * @var FW_Database
     */
    protected $db;
    
    /**
     * constructor
     * 
     * @access public
     */
    public function __construct(){
        $this->registry = FW_Registry::getInstance();
        $this->db = $this->registry->getDatabase();
    }
}
?>
