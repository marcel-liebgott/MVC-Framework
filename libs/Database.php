<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Database extends PDO{
    protected static $instance = null;

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new FW_Database(TYPE, HOST, USER, PASS, DATA);
        }

        return self::$instance;
    }

    public function __construct($type, $host, $user, $pass, $data){
        parent::__construct($type . ':host=' . $host. ';dbname=' . $data , $user, $pass);
        
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __clone(){
    }
    
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
        try{
            $sth = $this->prepare($sql);

            foreach($array as $key => &$value){
                $sth->bindParam("$key", $value);
            }
            
            $sth->execute();
            
            return $sth->fetchAll($fetchMode);
        }catch(PDOException $e){
            echo "Exception caught: " . $e->getMessage();
        }
    }
    
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
            
            $sth->execute();

            return $this->lastInsertId();
        }catch(PDOException $e){
            echo "Exception caught: " . $e->getMessage();
        }
    }
    
    public function update($table, $data, $where){
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
        
        $sth->execute();
    }
    
    public function delete($table, $where, $limit = 1){
        return $sth = $this->exec("DELETE FROM " . $table . " WHERE " . $where . " LIMIT " . $limit);
    }
    
    public function showTables(){
        $sth = $this->prepare("SHOW TABLES");
        
        $sth->execute();
        
        return $sth->fetchAll();
    }
    
    public function setNames($name){
        $sth = $this->prepare("SET NAMES " . $name);
        
        $sth->execute();
    }
}
?>
