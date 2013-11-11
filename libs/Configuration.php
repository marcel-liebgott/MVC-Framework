<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Configuration{
    private static $instance = null;
    private $config = array();
    
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new FW_Configuration();
        }
        
        return self::$instance;
    }
    
    public function __construct(){
    }
    
    public function __clone(){
    }
    
    public function setConfig($key, $value){
        $key = strtolower($key);
        $this->config[$key] = $value;
    }
    
    private function issetKey($key){
        if(isset($this->config[$key])){
            return true;
        }
        
        return false;
    }
    
    public function getConfig($key){
        $key = strtolower($key);
        if($this->issetKey($key)){
            return $this->config[$key];
        }
        
        return null;
    }
    
    public function readIni($path){
        if(file_exists($path)){
            $ini = parse_ini_file($path);
            
            foreach($ini as $key => $value){
                $this->setConfig($key, $value);
            }
        }else{
            throw new FW_Exception("can't find ini file");
        }
    }
}

?>
