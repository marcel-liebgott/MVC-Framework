<?php
if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * read config-ini file for application configuration
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @since 1.00
 */
class FW_Configuration{
    /**
     * instance
     *
     * @access private
     * @static
     * @var resource
     */
    private static $instance = null;

    /**
     * a array with all application configuration
     *
     * @access private
     * @var array
     */
    private $config = array();
    
    /**
     * get current singleton instance of this class
     *
     * @access public
     * @static
     * @return resource
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new FW_Configuration();
        }
        
        return self::$instance;
    }
    
    /**
     * constructor
     *
     * @access public
     */
    public function __construct(){
    }
    
    /**
     * copy
     *
     * @access public
     */
    public function __clone(){
    }
    
    /**
     * set a new config value
     *
     * @access public
     * @param string $key
     * @param string $value
     */
    public function setConfig($key, $value){
        if(FW_Validate::isMixed($key) && FW_Validate::isMixed($value)){
            $key = FW_String::strtolower($key);
            $this->config[$key] = $value;
        }
    }
    
    /**
     * check if an configuration key exists
     *
     * @access private
     * @param string $key
     * @return boolean
     */
    private function issetKey($key){
        if(isset($this->config[$key])){
            return true;
        }
        
        return false;
    }
    
    /**
     * get an configuration value
     *
     * @access public
     * @param string $key
     * @return string
     */
    public function getConfig($key){
        if(FW_Validate::isString($key)){
            $key = FW_String::strtolower($key);

            if($this->issetKey($key)){
                return $this->config[$key];
            }
            
            return null;
        }
    }
    
    /**
     * read ini file
     *
     * @access public
     * @param string $path
     */
    public function readIni($path){
        if(file_exists($path)){
            $ini = parse_ini_file($path);
            
            foreach($ini as $key => $value){
                $this->setConfig($key, $value);
            }
        }else{
            throw new FW_Exception_MissingData("can't find ini file");
        }
    }
}

?>
