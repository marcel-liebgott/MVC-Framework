<?php
if(!defined('PATH')){
    die("No direct script access allowed");
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
     * @return ressource
     */
    public static function getInstance(){
        return parent::__getInstance(get_class());
    }

    /**
     * constructer
     *
     * @access public
     */
    public function __construct(){
    	$config = FW_Registry::getInstance()->get(FW_Registry::KEY_CONFIGURATION);
    	self::$_use_db = $config->getConfig(new FW_String("use_database"));
    	 
    	if(self::$_use_db == true){
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
     * @param ressouce
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
     * @param string
     * @param array
     * @param int
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
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
        }
    }
    
    /**
     * insert new data into database
     *
     * @access public
     * @param string
     * @param array
     */
    public function insert($table, $data){
        try{
            ksort($data);
            
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));
            
            $sth = $this->prepare("INSERT INTO " . $table . " (`" . $fieldNames . "`) VALUES (" . $fieldValues . ")");
            
            foreach($data as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            
            $this->execute($sth);

            return $this->lastInsertId();
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
        }
    }
    
    /**
     * update a data
     *
     * @access public
     * @param string
     * @param array
     * @param string
     */
    public function update($table, $data, $where){
        try{
            ksort($data);
            
            $fieldDetails = '';
            
            foreach($data as $key => $value){
                $fieldDetails .= "`" . $key . "` = :" . $key . ",";
            }
            
            $fieldDetails = rtrim($fieldDetails, ',');
            
            $sth = $this->prepare("UPDATE " . $table . " SET " . $fieldDetails  . " WHERE " . $where);
            
            foreach($data as $key => $value){
                $sth->bindValue(":$key", $value);
            }
            
            $this->execute($sth);
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
        }
    }
    
    /**
     * delete data
     *
     * @access public
     * @param string
     * @param string
     * @param int
     */
    public function delete($table, $where, $limit = 1){
        try{
            $sth = $this->prepare("DELETE FROM " . $table . " WHERE " . $where . " LIMIT " . $limit);

            $this->execute($sth);

            return $sth;
        }catch(PDOException $e){
            throw new FW_Exception_QueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
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
     * @param string
     */
    public function setNames($name){
        $sth = $this->pdo->prepare("SET NAMES " . $name);
        
        $this->execute($sth);
    }

    /**
     * set transaction property
     *
     * @access public
     * @param boolean
     */
    public function setUseTransaction(bool $use){
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
            $this->beginTransaction();
        }
    }

    /**
     * commit a transaction
     *
     * @access public
     */
    public function commitTransaction(){
        if($this->getUseTransaction()){
            $this->commit();
        }
    }

    /**
     * rollback a transaction
     *
     * @access public
     */
    public function rollbackTransaction(){
        if($this->getUseTransaction()){
            $this->rollBack();
        }
    }

    /**
     * get last inserted id
     *
     * @access public
     * @return int
     */
    public function getLastInsertedId(){
        return $this->lastInsertId();
    }
    
    /**
     * return all columns of a database table
     * 
     * @access public
     * @since 1.02
     * @param String $table
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
