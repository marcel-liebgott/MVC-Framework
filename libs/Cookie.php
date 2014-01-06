<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of Cookie
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package nvc
 * @subpackage libs
 */
class FW_Cookie{    
    private $name;
    private $lifetime;
    private $value;
    private $path;
    private $domain;
    private $secure;
    private $httponly = true;
    
    const KEY_ONE_HOUR = 3600;
    const KEY_ONE_DAY = 86400;
    const KEY_ONE_WEEK = 604800;
    const KEY_ONE_MONTH = 2592000;
    const KEY_ONE_YEAR = 31536000;
    
    public function setCookie($name, $value, $lifetime, $path = null, $domain = null, $secure = false, $httponly = true){
        $val = new FW_Validate();
        $check = true;
        
        if($val->isString($name) == false || $val->isMixed($value) == false){
            $check = false;
        }
        
        $lifet = $lifetime + time();
        
        $this->setName($name);
        $this->setValue($value);
        $this->setLifetime($lifet);
        $this->setPath($path);
        $this->setDomain($domain);
        $this->setSecure($secure);
        $this->setHttpOnly($httponly);
        
        if($check == true){
            return setcookie($name, $value, $lifet, $path, $domain, $secure, $httponly);
        }
    }
    
    /**
     * return an existing cookie
     * 
     * @access public
     * @param string $name
     * @return mixed
     */
    public static function get($name){
        if($this->existsCookie($name)){
            return $_COOKIE[$name];
        }
        
        return false;
    }
    
    /**
     * set the name of the cookie
     * 
     * @access public
     * @param string $name
     */
    public function setName($name){
        $this->name = $name;
    }
    
    /**
     * set the value of the cookie
     * 
     * @access public
     * @param int $value
     */
    public function setValue($value){
        $this->value = $value;
    }
    
    /**
     * set lifetime of the cookie
     * 
     * @access public
     * @param int $lifetime
     * @throws FW_Exception
     */
    public function setLifetime($lifetime = self::KEY_ONE_YEAR){
        if(ctype_digit($lifetime)){
            $this->lifetime = (int) $lifetime;
        }else{
            throw new FW_Exception("lifetime for cookie isn't valide");
        }
    }
    
    /**
     * set the path of the cookie
     * 
     * @access public
     * @param string $path
     */
    public function setPath($path){
        $path = rtrim($path, '/') . '/';
        $this->path = $path;
    }
    
    /**
     * set the domain of the cookie
     * 
     * @access public
     * @param string $domain
     * @throws FW_Exception
     */
    private function setDomain($domain){
        if($domain !== null)
        if(filter_var($domain, FILTER_VALIDATE_URL)){
            $this->domain = $domain;
        }else{
            throw new FW_Exception("domain for cookie isn't valide");
        }
    }
    
    /**
     * set the secure of the cookie
     * 
     * @access public
     * @param boolean $secure
     */
    public function setSecure($secure){
        $this->secure = (boolean) $secure;
    }
    
    /**
     * set httponly of the cookie
     * 
     * @access public
     * @param boolean $httponly
     */
    public function setHttpOnly($httponly){
        $this->httponly = (boolean) $httponly;
    }
    
    /**
     * return the name of the cookie
     * 
     * @access public
     * @return string
     */
    public function getName(){
        return $this->name;
    }
    
    /**
     * return the value of the cookie
     * 
     * @access public
     * @return string
     */
    public function getValue(){
        return $this->value;
    }
    
    /**
     * return the lifetime of the cookie
     * 
     * @access public
     * @return int
     */
    public function getLifetime(){
        return $this->lifetime;
    }
    
    /**
     * return the path of the cookie
     * 
     * @access public
     * @return string
     */
    public function getPath(){
        return $this->name;
    }
    
    /**
     * return the domain of the cookie
     * 
     * @access public
     * @return string
     */
    private function getDomain(){
        return $this->name;
    }
    
    /**
     * return the secure of the cookie
     * 
     * @access public
     * @return boolean
     */
    public function getSecure(){
        return $this->secure;
    }
    
    /**
     * return the httponly of the cookie
     * 
     * @access public
     * @return boolean
     */
    public function getHttpOnly(){
        return $this->httponly;
    }
    
    /**
     * check if exists an cookie
     * 
     * @access public
     * @param string $name
     * @return boolean
     */
    public function existsCookie($name){
        if(isset($_COOKIE[$name]) && !empty($_COOKIE[$name]) && $_COOKIE[$name]){
            return true;
        }else{
            return false;
        }
    }
}

?>
