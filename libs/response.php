<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Response
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @category Marcel Liebgott
 */
class FW_Response extends FW_Singleton{
	/**
	 * header array
	 * 
	 * @access private
	 * @var array
	 */
    private $headers = array();
    
    /**
     * response content
     * 
     * @access private
     * @var String
     */
    private $content = '';
    
    /**
     * HTTP status
     * 
     * @access private
     * @var String
     */
    private $status = "200 OK";
    
    /**
     * return the instance, because is an singleton class
     * 
     * @access public
     * @return type $instace
     */
    public static function getInstance(){
        return parent::_getInstance(get_class());
    }
    
    /**
     * add an header element
     * 
     * @access public
     * @param string $name
     * @param string $content
     */
    public function addHeader($name, $content){
        $this->headers[$name] = $content;
    }
    
    /**
     * set an new status
     * 
     * @access public
     * @param string $status
     */
    public function setStatus($status){
        $this->status = $status;
    }
    
    /**
     * add an content
     * 
     * @access public
     * @param string $content
     */
    public function addContent($content){
        $this->content .= $content;
    }
    
    /**
     * return the current content
     * 
     * @access public
     * @return type string
     */
    public function getContent(){
        return $this->content;
    }
    
    /**
     * replace the current content with an new content
     * 
     * @access public
     * @param string $content
     */
    public function replaceContent($content){
        $this->content = $content;
    }
    
    /**
     * send the current header and content
     * 
     * @access public
     */
    public function send(){
        header("HTTP/1.0 " . $this->status);
        
        foreach($this->headers as $name => $content){
            header($name . ": " . $content);
        }
        
        $this->content = "";
        $this->headers = null;
    }
    
    /**
     * to redirect to an other website
     * 
     * @param string $url
     * @param boolean $immediately - redirect know
     */
    public function redirectUrl($url, $immediately = false){
        $url = PATH . $url;
        $url = FW_Security::cleanUrl($url);
        $this->addHeader("Location", $url);
        
        if($immediately == true){
            $this->send();
        }
    }
}

?>