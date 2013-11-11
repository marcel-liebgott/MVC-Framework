<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

class FW_Registry{
	private static $instance = null;
    private static $values = array();
    
    const KEY_DATABASE = 'database';
    const KEY_REQUEST = 'request';
    const KEY_RESPONSE = 'response';
    const KEY_CONFIGURATION = 'config';
    const KEY_LANGUAGE = 'lang';
    const KEY_MESSAGES = 'msg';
    const KEY_LOGGER = 'logger';

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FW_Registry();
        }
        
        return self::$instance;
    }

    public function __construct(){
    }
    
    public function __clone(){
    }
    
    public static function set($key, $value){
        self::$values[$key] = $value;
    }
    
    public static function get($key){
        if(isset(self::$values[$key])){
            return self::$values[$key];
        }
    }
    
    public function setDatabase($data){
        self::set(self::KEY_DATABASE, $data);
    }
    
    public function getDatabase(){
        return self::get(self::KEY_DATABASE);
    }
    
    public function setRequest(FW_Request $request){
        self::set(self::KEY_REQUEST, $request);
    }
    
    public function getRequest(){
        return self::get(self::KEY_REQUEST);
    }
    
    public function setResponse(FW_Response $response){
        self::set(self::KEY_RESPONSE, $response);
    }
    
    public function getResponse(){
        return self::get(self::KEY_RESPONSE);
    }
    
    public function setMessages(FW_Messages $response){
        self::set(self::KEY_MESSAGES, $response);
    }
    
    public function getMessages(){
        return self::get(self::KEY_MESSAGES);
    }
    
    public function setConfiguration(FW_Configuration $config){
        self::set(self::KEY_CONFIGURATION, $config);
    }
    
    public function getConfiguration(){
        return self::get(self::KEY_CONFIGURATION);
    }
    
    public function setLanguage(FW_Language $lang){
        self::set(self::KEY_LANGUAGE, $lang);
    }
    
    public function getLanguage(){
        return self::get(self::KEY_LANGUAGE);
    }

    public function setLogger(FW_Logger $logger){
        self::set(self::KEY_LOGGER, $logger);
    }

    public function getLogger(){
        return self::get(self::KEY_LOGGER);
    }
}
?>