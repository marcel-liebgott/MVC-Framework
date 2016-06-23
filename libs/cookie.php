<?php
if(!defined('PATH')){
    throw new FW_Exception_AccessDenied("No direct script access allowed");
}

/**
 * Description of Cookie
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Cookie{
    /**
     * name of the cookie
     *
     * @access private
     * @var string
     */   
    private $name;

    /**
     * lifetime of the cookie
     *
     * @access private
     * @var int
     */
    private $lifetime;

    /**
     * value of the cookie
     *
     * @access private
     * @var string
     */
    private $value;

    /**
     * path of the cookie
     *
     *
     * @access private
     * @var string
     */
    private $path;

    /**
     * domain of the cookie
     *
     * @access private
     * @var string
     */
    private $domain;

    /**
     * use ssl secure
     *
     * @access private
     * @var boolean
     */
    private $secure;

    /**
     * use http only
     *
     * @access private
     * @var boolean
     */
    private $httponly = true;
    
    const KEY_ONE_HOUR = 3600;
    const KEY_ONE_DAY = 86400;
    const KEY_ONE_WEEK = 604800;
    const KEY_ONE_MONTH = 2592000;
    const KEY_ONE_YEAR = 31536000;

    /**
     * constructor
     * 
     * @access public
     * @since 1.00
     * @param string $path
     * @param string $domain
     * @param string $secure
     * @param string $httponly
     */
    public function __construct($path = '/', $domain = '', $secure = false, $httponly = false){
		$this->setPath($path);
		$this->domain = $domain;
		$this->setSecure($secure);
		$this->setHttpOnly($httponly);
    }
    
    /**
     * create an cookie
     * 
     * @access public
     * @since 1.02
     * @param String $name
     * @param Mixed $value
     * @param int $lifetime
     */
    public function setCookie($name, $value, $lifetime = self::KEY_ONE_DAY){
    	$lifetime = $lifetime + time();
    	setcookie(COOKIE_PREFIX . $name, $value, $lifetime, $this->path, $this->domain, $this->secure, $this->httponly);
    }
    
    /**
     * return an existing cookie
     * 
     * @access public
     * @param string $name
     * @return mixed
     */
    public static function get($name){
        if(self::existsCookie($name)){
            return $_COOKIE[COOKIE_PREFIX . $name];
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
        if(FW_Validate::isInteger($lifetime)){
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
        if(FW_Validate::isValidUrl($domain)){
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
     * @static
     * @param string $name
     * @return boolean
     */
    public static function existsCookie($name){
    	$name = COOKIE_PREFIX . $name;
    	
        if(isset($_COOKIE[$name]) && !empty($_COOKIE[$name]) && $_COOKIE[$name]){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * delete an cookie
     * 
     * @access public
     * @since 1.02
     * @param String $name
     */
    public function delete($name){
    	if(self::existsCookie($name)){
    		setcookie(COOKIE_PREFIX . $name, '', time() - 3600);
    	}
    }
}
?>
