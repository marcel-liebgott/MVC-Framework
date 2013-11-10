<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of FW_Session
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */
class FW_Session{

    public function __construct(){
        
    }
    
    public static function init(){
        @session_start();
    }


    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }
    
    public static function destroy(){
        session_destroy();
    }
}

?>