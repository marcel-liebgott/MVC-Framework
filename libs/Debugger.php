<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * to debug your project
 * you could switch between print the status on the screen ot save into file
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package MVC
 * @subpackage libs
 */
class FW_Debugger{
    protected static $instance = null;
    protected $properties = array();
    
    /**
     * save and return the instance
     * 
     * @access public
     * @return object
     */
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FW_Debugger();
        }
        
        return self::$instance;
    }
    
    /**
     * constructer
     */
    protected function __construct(){
        $config = FW_Registry::getInstance()->getConfiguration();
        
        $this->properties['screen_logging'] = $config->getConfig('debugger_screen_logging');
        $this->properties['file_logging'] = $config->getConfig('debugger_file_logging');
        $this->properties['file'] = $config->getConfig('debugger_log_file');
    }
    
    public function __clone(){
    }
    
    /**
     * managed the errors and redirect to the methods
     * 
     * @access public
     * @param string $message
     * @param string $file
     * @param string $line
     * @param boolean $exception
     * @throws Exception
     */
    public function  error($message, $file = null, $line = null, $exception = false){
        if($this->properties['file_logging'] == 1){
            $this->logFile($message, $file, $line);
        }
        
        if($this->properties['screen_logging'] == 1){
            $this->logScreen($message, $file, $line, true);
        }
        
        if($exception === true){
            throw new Exception($message);
        }
    }
    
    /**
     * save an new entry in the log file
     * 
     * @access protected
     * @param string $message
     * @param string $file
     * @param string $line
     * @throws FW_Exception
     */
    protected function logFile($message, $file, $line){
        $handle = fopen($this->properties['file'], 'a');
        
        if($handle){
            $request = FW_Registry::getInstance()->getRequest();
            
            $string = date("d.m.Y - H:i:s", time()) . " | " . $request->getIpAdress();
            $string .= " | File: " . $file . " | Line: " . $line . " | " . $message . "\r\n";
            
            fwrite($handle, $string);
            
            fclose($handle);
        }else{
            throw new FW_Exception("can't open log file");
        }
    }
    
    /**
     * print the error on the screen
     * 
     * @access protected
     * @param string $message
     * @param string $file
     * @param string $line
     * @param boolean $die
     */
    protected function logScreen($message, $file, $line, $die){
        $message = "Error: " . $message . " \r\n";
        
        if($file !== null){
            $message .= "File: " . $file . "\r\n";
        }
        
        if($line == null){
            $message .= "Line: " . $line . "\r\n";
        }
        
        if($die == true){
            die($message);
        }else{
            echo $message;
        }
    }
    
    /**
     * register the error handler
     * 
     * @access public
     */
    public static function registerErrorHandler(){
        set_error_handler(array("FW_Debugger", "handleError"));
    }
    
    /**
     * handle error which coming over error_handler
     * 
     * @access public
     * @param int $errNo
     * @param string $errStr
     * @param string $errFile
     * @param string $errLine
     * @param mixed $context
     */
    public static function handleError($errNo, $errStr = null, $errFile = null, $errLine = null, $context = null){
        $config = FW_Registry::getInstance()->getConfiguration();
        
        if($errNo == E_NOTICE || $errNo == E_STRICT){
            if($config->get('debugger_handle_unimportant') == 1){
                $this->error($errNo . ": " . $errStr, $errFile, $errLine, false);
            }
        }else{
            $this->error($errNo . ": " . $errStr, $errFile, $errLine, false);
        }
    }
}
?>
