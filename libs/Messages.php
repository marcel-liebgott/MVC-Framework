<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of Error
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */
class FW_Messages{
    private static $instance = null;

    const _E_ERROR = 'Error';
    const _E_NOTICE = 'Notice';
    const _E_WARNING = 'Warning';
    
    private $value = array();
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FW_Messages();
        }
        
        return self::$instance;
}
    
    public function __construct(){
    }
    
    public function __clone(){
    }
    
    public function setMessage($msg, $level = self::_E_ERROR, $output = true){
        // maybe log if output is false
        if($output == true){
            $this->value[] = array($level, $msg);
        }
    }
    
    public function getMessage(){
        if(isset($this->value[0])){
            $count = count($this->value);
            $this->value[] = null;
            
            return $this->value[$count];
        }
    }
}

?>
