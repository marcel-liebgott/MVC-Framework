<?php
/**
 * database interface
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
interface FW_Interface_Database{
	/**
	 * execute the current statement
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $sth
	 */
	public function execute($sth);
	
	/**
	 * database select query
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $sql
	 * @param array $array
	 * @param int $fetchMode
	 */
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC);
	
	/**
	 * database insert query
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $table
	 * @param array $data
	 */
	public function insert($table, $data);
	
	/**
	 * database update query
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $table
	 * @param array $data
	 * @param String $where
	 */
	public function update($table, $data, $where);
	
	/**
	 * database delete query
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $table
	 * @param String $where
	 * @param int $limit
	 */
	public function delete($table, $where, $limit = 1);
	
	/**
	 * show all database tables
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function showTables();
	
	/**
	 * set names
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $name
	 */
	public function setNames($name);
	
	/**
	 * start a transaction
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function startTransaction();
	
	/**
	 * commit a transaction
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function commitTransaction();
	
	/**
	 * rollback a transaction
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function rollbackTransaction();
	
	/**
	 * return the last inserted id
	 * 
	 * @access public
	 * @since 1.01
	 * @return int
	 */
	public function getLastInsertedId();
}
?>
