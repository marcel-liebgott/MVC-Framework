<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * Request
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @category Marcel Liebgott
 */
class FW_Request{
	/**
	 * post request
	 *
	 * @access private
	 * @var array
	 */
	private $post = array();

	/**
	 * get request
	 *
	 * @access private
	 * @var array
	 */
	private $get = array();

	/**
	 * cookie request
	 * 
	 * @access private
	 * @var array
	 */
	private $cookie = array();

	/**
	 * file request
	 * 
	 * @access private
	 * @var array
	 */
	private $file = array();

	/**
	 * header request information
	 *
	 * @access private
	 * @var array
	 */
	private $header = array();

	/**
	 * authetification request infotmation
	 *
	 * @access private
	 * @var array
	 */
	private $auth = array();

    /**
     * referer page
     *
     * @access private
     * @var string
     */
    private $referer;

	/**
	 * obkject instance
	 *
	 * @access private
	 * @var instance
	 */
	private static $instance = null;

	/**
	 * return the singleton instance of this class
	 * 
	 * @access public
	 * @return instance
	 */
	public static function getInstance(){
		if(self::$instance == null){
			self::$instance = new FW_Request();
		}

		return self::$instance;
	}

	/**
	 * constructer
	 *
	 * @access public
	 */
	public function __construct(){
		$this->post = &$_POST;
		$this->get = &$_GET;
		$this->cookie = &$_COOKIE;
		$this->file = &$_FILE;

		// search HTTP information
		foreach($_SERVER as $key => $value){
            if(substr($key,0, 5) == "HTTP_"){
                $key = strtolower($key);
                $this->header[substr($key, 5)] = $value;
            }

            if($key == "HTTP_REFERER"){
                $this->referer = $value;
            }
        }
        
        // get user authetification information
        if(isset($_SERVER["HTTP_AUTH_USER"])){
            $this->auth["user"] = $_SERVER["PHP_AUTH_USER"];
            $this->auth["pass"] = $_SERVER["PHP_AUTH_PW"];
        }else{
            $this->auth = null;
        }
        
        // ip adress
        if(isset($_SERVER["REMOTE_ADDR"])){
            $this->auth['ip_adress'] = $_SERVER["REMOTE_ADDR"];
        }else{
            $this->auth['ip_adress'] = null;
        }
        
        // user agent
        if(isset($_SERVER["HTTP_USER_AGENT"])){
            $this->auth['user_agent'] = $_SERVER["HTTP_USER_AGENT"];
        }else{
            $this->auth['user_agent'] = null;
        }
    }
    
    /**
     * return authentification information
     *
     * @access public
     * @return array
     */
    public function getAuthData(){
        return $this->auth;
    }
    
    /**
     * check the header information
     *
     * @access public
     * @return boolean
     */
    public function issetHeader($key){
        if(isset($key)){
            return true;
        }
        
        return false;
    }
    
    /**
     * return a header information, if they exists
     *
     * @access public
     * @return mixed
     */
    public function getHeader($key){
        $key = strtolower($key);
        
        if($this->getHeader($key)){
            return $this->header[$key];
        }
        
        return null;
    }

    /**
     * check if a $_GET information exists
     *
     * @access public
     * @return boolean
     */
    public function issetGet($key){
        if(isset($this->get[$key])){
            return true;
        }
        
        return false;
    }
    
    /**
     * return a $_GET information
     *
     * @access public
     * @return mixed
     */
    public function getGet($key){
        $key = strtolower($key);
        
        if($this->issetGet($key)){
            return $this->get[$key];
        }
        
        return null;
    }
    
    /**
     * check if a $_POST information exists
     *
     * @access public
     * @return boolean
     */
    public function issetPost($key){
        if(isset($this->post[$key])){
            return true;
        }
        
        return false;
    }
    
    /**
     * return a $_POST information, if they exists
     *
     * @access public
     * @return mixed
     */
    public function getPost($key){
        $key = FW_Stringhelper::strtolower($key);
        
        
        if($this->issetPost($key)){
            return $this->post[$key];
        }
        
        return null;
    }
    
    /**
     * check if a file exists
     *
     * @access public
     * @return boolean
     */
    public function issetFile($key){
        if(isset($this->file[$key])){
            return true;
        }
        
        return false;
    }
    
    /**
     * return a file
     *
     * @access public
     * @return array
     */
    public function getFile($key){
        $key = FW_Stringhelper::strtolower($key);
        
        if($this->issetFile($key)){
            return $this->file[$key];
        }
        
        return null;
    }
    
    /**
     * return the user agent
     *
     * @access public
     * @return string
     */
    public function getUserAgent(){
        return $this->auth['user_agent'];
    }
    
    /**
     * return the ip adress
     *
     * @access public
     * @return mixed
     */
    public function getIpAdress(){
        return $this->auth['ip_adress'];
    }
    
    /**
     * return the current url
     *
     * @access public 
     * @return array
     */
    public function getUrl(){
        $url = $_GET;
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        
        $url = explode('/', $url);
        
        return $url;
    }
    
    /**
     * return a cookie, if they exists
     *
     * @access public
     * @return mixed
     */
    public function getCookie($name){
        if(isset($this->cookie[$name])){
            return $this->cookie[$name];
        }else{
            return null;
        }
    }

    /**
     * return the referer
     *
     * @access public
     * @return string
     */
    public function getReferer(){
        return $this->referer;
    }
}
?>