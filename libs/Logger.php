<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Logger{
    private $logFile = null;
    private $logPath = null;
    private $logContent = null;
    
    public function __construct($logFile,  $logPath, $logMessage){
        if(!empty($logFile) && !empty($logPath) && !empty($logMessage)){
            $this->setLogFile($logFile);

            $this->setLogPath($logPath);

            $request = FW_Registry::getInstance()->getRequest();

            $log = array(date('Y-m-d H:i:s'), $request->getAuthData()['ip_adress'], $logMessage);

            $this->setLogContent($log);
            
            $this->log();
        }else{
            throw new FW_Exception("Logger parameters invalid");
        }        
    }

    private function setLogFile($fileName){
        $this->logFile = $fileName;
    }

    private function setLogPath($logPath){
        if($this->existsPath($logPath) == false){
            mkdir($logPath);
        }
        
        $this->logPath = rtrim($logPath, '/') . '/';
    }
    
    private function setLogContent($logMessage = array()){
        $this->logContent = $logMessage;
    }
    
    private function getLogPath(){
        return $this->logPath;
    }
    
    private function getLogFile(){
        return $this->logFile;
    }
    private function getLogContent(){
        
        return $this->logContent;        
    }
    
    private function log(){
        error_log(implode('|', $this->getLogContent()) . "\n", 3, $this->getLogPath() . $this->getLogFile());
    }
    
    private function existsPath($logPath){
        if(is_dir($logPath)){
            return true;
        }
        
        return true;
    }
}

?>