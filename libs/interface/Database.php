<?php

interface FW_Interface_Database{
	public function execute($sth);
	
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC);
	
	public function insert($table, $data);
	
	public function update($table, $data, $where);
	
	public function delete($table, $where, $limit = 1);
	
	public function showTables();
	
	public function setNames($name);
	
	public function startTransaction();
	
	public function commitTransaction();
	
	public function rollbackTransaction();
	
	public function getLastInsertedId();
}
?>