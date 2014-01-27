<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Auth{
    public function __construct() {
    }

    public static function handleLogin(){
        FW_Session::init();
        $logged = FW_Session::get('sessionId');
        
        if($logged == false){
            FW_Session::destroy();
            $response = FW_Registry::getInstance()->getResponse();
            $response->redirectUrl('acp/login/', true);
            exit;
        }
    }
    
    /**
     * is Visitor an visitor with enabled operating systems
     * 
     * @access public
     * @param string $userAgent
     * @return boolean
     */
    public static function isVisitor($userAgent){
        $os = array('win', 'android', 'linux', 'mac', 'freebsd', 'solaris', 'unix');
        
        foreach($os as $o){
            if(stripos($userAgent, $o) == true){
                return true;
            }
        }
        
        return false;
    }
}

?>