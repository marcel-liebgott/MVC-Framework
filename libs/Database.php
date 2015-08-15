<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Database extends FW_Abstract_Database implements FW_Interface_Database{
	private static $pdo = PDO;
    /**
     * use transaction
     *
     * @access private
     * @var boolean
     */
    private $use_transaction = false;

    /**
     * get instance of this class - singleton
     *
     * @access public
     * @return ressource
     */
    public static function getInstance(){
        return parent::_getInstance(get_class());
    }

    /**
     * constructer
     *
     * @access public
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     */
    public function __construct($type, $host, $user, $pass, $data){
        try{
            parent::__construct($type . ':host=' . $host. ';dbname=' . $data , $user, $pass);    
            
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            throw new FW_Exception_DBConnectionFailure(PDO::errorInfo(), PDO::errorCode());
        }
    }

    public function __clone(){
    }

    /**
     * execute database query
     *
     * @access public
     * @param ressouce
     */
    public function execute($sth){
        $profiler = new FW_Profiler();

        $profiler->start();
        
        $sth->execute();

        $profiler->getTime();
    }
    
    /**
     * select data from table
     *
     * @access public
     * @param string
     * @param array
     * @param int
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
        try{
            $sth = $this->prepare($sql);

            foreach($array as $key => &$value){
                $sth->bindParam("$key", $value);
            }
            
            $this->execute($sth);

            /*echo '<pre>';
                print_r($sth);
            echo '</pre>';*/
            
            return $sth->fetchAll($fetchMode);
        }catch(PDOException $e){
            throw new FW_ExceptionQueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
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
            
            /*echo '<pre>';
                print_r($sth);
            echo '</pre>';*/
            
            $this->execute($sth);

            return $this->lastInsertId();
        }catch(PDOException $e){
            throw new FW_ExceptionQueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
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

            /*echo '<pre>';
                print_r($sth);
            echo '</pre>';*/
            
            $this->execute($sth);
        }catch(PDOException $e){
            throw new FW_ExceptionQueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
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
            throw new FW_ExceptionQueryFailure($e->getMessage(), $sth['queryString'], PDO::errorCode());
        }
    }
    
    /**
     * get all tables
     *
     * @access public
     * @return array
     */
    public function showTables(){
        $sth = $this->prepare("SHOW TABLES");
        
        $this->execute($sth);
        
        return $sth->fetchAll();
    }
    
    /**
     * set database encoding
     *
     * @access public
     * @param string
     */
    public function setNames($name){
        $sth = $this->prepare("SET NAMES " . $name);
        
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
}
?>
