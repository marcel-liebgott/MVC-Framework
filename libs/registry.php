<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Registry extends FW_Singleton{
    /**
     * array of saved instances
     *
     * @access private
     * @static
     * @var array
     */
    private static $values = array();
    
    const KEY_DATABASE = 'database';
    const KEY_REQUEST = 'request';
    const KEY_RESPONSE = 'response';
    const KEY_CONFIGURATION = 'config';
    const KEY_LANGUAGE = 'lang';

    /**
     * get instance
     *
     * @access public
     * @static
     * @return FW_Registry
     */
    public static function getInstance(){
       return parent::_getInstance(get_class());
    }

    /**
     * constructor
     *
     * @access public
     */
    public function __construct(){}
    
    /**
     * copy
     *
     * @access public
     */
    public function __clone(){}
    
    /**
     * set a instance
     *
     * @access public
     * @static
     * @param string $key
     * @param object $value
     */
    public static function set($key, $value){
        self::$values[$key] = $value;
    }
    
    /**
     * get a instance
     *
     * @access public
     * @static
     * @param string $key
     * @return object
     */
    public static function get($key){
        if(isset(self::$values[$key])){
            return self::$value;
        }
        
        return null;
    }
    
    /**
     * set database instance
     *
     * @access public
     * @param FW_Database $data
     */
    public function setDatabase($data){
        self::set(self::KEY_DATABASE, $data);
    }
    
    /**
     * get database instance
     *
     * @access public
     * @return FW_Database
     */
    public function getDatabase(){
        return self::get(self::KEY_DATABASE);
    }
    
    /**
     * set request instance
     *
     * @access public
     * @param FW_Request $request
     */
    public function setRequest(FW_Request $request){
        self::set(self::KEY_REQUEST, $request);
    }
    
    /**
     * get request instance
     *
     * @access public
     * @return FW_Request
     */
    public function getRequest(){
        return self::get(self::KEY_REQUEST);
    }
    
    /**
     * set response instance
     *
     * @access public
     * @param FW_Response $response
     */
    public function setResponse(FW_Response $response){
        self::set(self::KEY_RESPONSE, $response);
    }
    
    /**
     * get response instance
     *
     * @access public
     * @return FW_Response
     */
    public function getResponse(){
        return self::get(self::KEY_RESPONSE);
    }
    
    /**
     * set configuration instance
     *
     * @access public
     * @param FW_Configuration $config
     */
    public function setConfiguration(FW_Configuration $config){
        self::set(self::KEY_CONFIGURATION, $config);
    }
    
    /**
     * get configuration instance
     *
     * @access public
     * @return FW_Configuration 
     */
    public function getConfiguration(){
        return self::get(self::KEY_CONFIGURATION);
    }
    
    /**
     * set languages instance
     *
     * @access public
     * @param FW_Language $lang
     */
    public function setLanguage(FW_Language $lang){
        self::set(self::KEY_LANGUAGE, $lang);
    }
    
    /**
     * get languages instance
     *
     * @access public
     * @return FW_Language
     */
    public function getLanguage(){
        return self::get(self::KEY_LANGUAGE);
    }
}
?>
