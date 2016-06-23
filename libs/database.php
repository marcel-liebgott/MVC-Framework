<?php
if(!defined('PATH')){
    throw new FW_Exception_AccessDenied("No direct script access allowed");
}

/**
 * class to work with databases
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Database extends FW_Abstract_Database implements FW_Interface_Database{
	/**
	 * pdo database instance
	 * 
	 * @access private
	 * @static
	 * @var PDO instance
	 */
	private $pdo = null;
	
    /**
     * use transaction
     *
     * @access private
     * @var boolean
     */
    private $use_transaction = false;
    
    /**
     * use database
     * 
     * @access private
     * @static
     * @var boolean
     */
    private static $_use_db = false;

    /**
     * get instance of this class - singleton
     *
     * @access public
     * @return FW_Database
     */
    public static function getInstance(){
        return parent::__getInstance(get_class());
    }

    /**
     * constructer
     *
     * @access public
     * @throws FW_Exception_DBConnectionFailure
     */
    public function __construct(){
    	parent::__construct();
    	
    	self::$_use_db = parent::$config->getConfig('use_database');
    	 
    	if(self::$_use_db === true){
    		try{
	            $this->pdo = new PDO(TYPE . ':host=' . HOST. ';dbname=' . DATA , USER, PASS);
	            
	            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        }catch(PDOException $e){
	            throw new FW_Exception_DBConnectionFailure($e->getMessage(), $e->getCode());
	        }
        }
    }

    /**
     * execute database query
     *
     * @access public
     * @throws FW_Exception_DBFailure
     * @param PDOStatement $sth
     */
    public function execute($sth){
    	try{
	    	if(self::$_use_db){
		        $profiler = new FW_Profiler();
		
		        $profiler->start();
		        
		        $sth->execute();
		
		        $profiler->getTime();
	    	}
    	}catch(PDOException $e){
    		throw new FW_Exception_DBFailure($e->getMessage(), $e->getCode());
    	}
    }
    
    /**
     * select data from table
     *
     * @access public
     * @throws FW_Exception_QueryFailure
     * @param string $sql
     * @param array $array
     * @param int $fetchMode
     * @return FW_Array
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
        try{
            $sth = $this->pdo->prepare($sql);

            foreach($array as $key => &$value){
                $sth->bindParam("$key", $value);
            }
            
            $this->execute($sth);
            
            return new FW_Array($sth->fetchAll($fetchMode));
        	if(self::$_use_db){
	            $sth = $this->pdo->prepare($sql);
	
	            foreach($array as $key => &$value){
	                $sth->bindParam("$key", $value);
	            }
	            
	            $this->execute($sth);
	            
	            return new FW_Array($sth->fetchAll($fetchMode));
        	}
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString']);
        }
    }
    
    /**
     * insert new data into database
     *
     * @access public
     * @throws FW_Exception_QueryFailure
     * @param string $table
     * @param array $data
     * @return string
     */
    public function insert($table, $data){
        try{
            ksort($data);
            
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));
            
            $sth = $this->pdo->prepare("INSERT INTO " . $table . " (`" . $fieldNames . "`) VALUES (" . $fieldValues . ")");
            
            foreach($data as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            
            $this->execute($sth);

            return $this->getLastInsertedId();
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString']);
        }
    }
    
    /**
     * update a data
     *
     * @access public
     * @throws FW_Exception_QueryFailure
     * @param string $table
     * @param array $data
     * @param string $where
     */
    public function update($table, $data, $where){
        try{
            ksort($data);
            
            $fieldDetails = '';
            
            foreach($data as $key => $value){
                $fieldDetails .= "`" . $key . "` = :" . $key . ",";
            }
            
            $fieldDetails = rtrim($fieldDetails, ',');
            
            $sth = $this->pdo->prepare("UPDATE " . $table . " SET " . $fieldDetails  . " WHERE " . $where);
            
            foreach($data as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            
            $this->execute($sth);
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString']);
        }
    }
    
    /**
     * delete data
     *
     * @access public
     * @throws FW_Exception_QueryFailure
     * @param string $table
     * @param string $where
     * @param int $limit
     * @return PDOStatement
     */
    public function delete($table, $where, $limit = 1){
        try{
            $sth = $this->pdo->prepare("DELETE FROM " . $table . " WHERE " . $where . " LIMIT " . $limit);

            $this->execute($sth);

            return $sth;
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString']);
        }
    }
    
    /**
     * get all tables
     *
     * @access public
     * @return FW_Array
     */
    public function showTables(){
        $sth = $this->pdo->prepare("SHOW TABLES");
        
        $this->execute($sth);
        
        return new FW_Array($sth->fetchAll());
    }
    
    /**
     * set database encoding
     *
     * @access public
     * @param string $name
     */
    public function setNames($name){
        $sth = $this->pdo->prepare("SET NAMES " . $name);
        
        $this->execute($sth);
    }

    /**
     * set transaction property
     *
     * @access public
     * @param boolean $use
     */
    public function setUseTransaction($use){
        $this->use_transaction = $use;
    }

    /**
     * return the transaction property
     *
     * @access public
     * @return boolean
     */
    public function getUseTransaction(){
        return $this->use_transaction;
    }

    /**
     * starts a transaction
     *
     * @access public
     */
    public function startTransaction(){
        if($this->getUseTransaction()){
            $this->pdo->beginTransaction();
        }
    }

    /**
     * commit a transaction
     *
     * @access public
     */
    public function commitTransaction(){
        if($this->getUseTransaction()){
            $this->pdo->commit();
        }
    }

    /**
     * rollback a transaction
     *
     * @access public
     */
    public function rollbackTransaction(){
        if($this->getUseTransaction()){
            $this->pdo->rollBack();
        }
    }

    /**
     * get last inserted id
     *
     * @access public
     * @return string
     */
    public function getLastInsertedId(){
        return $this->pdo->lastInsertId();
    }
    
    /**
     * return all columns of a database table
     * 
     * @access public
     * @since 1.02
     * @param string $table
     * @return array
     */
    public function getTableColumns($table){
    	if(self::$_use_db){
    		$sth = $this->pdo->prepare("SELECT * FROM " . $table);
    		$sth->execute();
    		$col_count = $sth->columnCount();
    		$column = array();
    		
    		for($i = 0; $i < $col_count; $i++){
    			$column[] = $sth->getColumnMeta($i)['name'];
    		}
    	
    		return $column;
    	}
    }
}
?>
