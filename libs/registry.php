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
     * @return resource
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
     * @param resource $value
     */
    public static function set($key, $value){
        self::$values[$key] = $value;
    }
    
    /**
     * get a instance
     *
     * @access public
     * @static
     * @param string $ley
     */
    public static function get($key){
        if(isset(self::$values[$key])){
            return self::$values[$key];
        }

        print_r(self::$values);
    }
    
    /**
     * set database instance
     *
     * @access public
     * @param resource $data
     */
    public function setDatabase($data){
        self::set(self::KEY_DATABASE, $data);
    }
    
    /**
     * get database instance
     *
     * @access public
     * @return resource $data
     */
    public function getDatabase(){
        return self::get(self::KEY_DATABASE);
    }
    
    /**
     * set request instance
     *
     * @access public
     * @param resource $data
     */
    public function setRequest(FW_Request $request){
        self::set(self::KEY_REQUEST, $request);
    }
    
    /**
     * get request instance
     *
     * @access public
     * @param resource $data
     */
    public function getRequest(){
        return self::get(self::KEY_REQUEST);
    }
    
    /**
     * set response instance
     *
     * @access public
     * @param resource $data
     */
    public function setResponse(FW_Response $response){
        self::set(self::KEY_RESPONSE, $response);
    }
    
    /**
     * get response instance
     *
     * @access public
     * @param resource $data
     */
    public function getResponse(){
        return self::get(self::KEY_RESPONSE);
    }
    
    /**
     * set configuration instance
     *
     * @access public
     * @param resource $data
     */
    public function setConfiguration(FW_Configuration $config){
        self::set(self::KEY_CONFIGURATION, $config);
    }
    
    /**
     * get configuration instance
     *
     * @access public
     * @param resource $data
     */
    public function getConfiguration(){
        return self::get(self::KEY_CONFIGURATION);
    }
    
    /**
     * set languages instance
     *
     * @access public
     * @param resource $data
     */
    public function setLanguage(FW_Language $lang){
        self::set(self::KEY_LANGUAGE, $lang);
    }
    
    /**
     * get languages instance
     *
     * @access public
     * @param resource $data
     */
    public function getLanguage(){
        return self::get(self::KEY_LANGUAGE);
    }
}
?>
