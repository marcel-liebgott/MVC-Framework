<?php
/**
 * Description of FW_Session
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */
class FW_Session{
    /**
     * constructor
     *
     * @access public
     */
    public function __construct(){
    }
    
    /**
     * initialize session
     *
     * @access public
     * @static
     */
    public static function init(){
        @session_start();
    }

    /**
     * register a new session
     *
     * @access public
     * @static
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    /**
     * get a session
     *
     * @access public
     * @static
     * @param string $key
     * @return mixed
     */
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }
    
    /**
     * destroy all session
     *
     * @access public
     * @static
     */
    public static function destroy(){
        session_destroy();
    }
    
    /**
     * remove a session by given name
     * 
     * @access public
     * @static
     * @since 1.02
     * @param String $name
     */
    public static function remove($name){
    	unset($_SESSION[$name]);
    }
}
?>
