<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of Breadcrumb
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Breadcrumb{
    private static $instance = null;
    
    private static $breadcrumb = array();
    
    const BREADCRUMB_SEPARATOR = ' &raquo; ';
    
    /**
     * constructor
     * 
     * @since 1.00
     * @return FW_Breadcrumb
     */
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FW_Breadcrumb();
        }
        
        return self::$instance;
    }
    
    public function __construct(){
    }
    
    /**
     * add an new breadcrumb item
     * 
     * @access public
     * @param string $name
     * @param string $url
     */
    public function addBreadcrumb($name, $url = ''){
        self::$breadcrumb[] = array($name, $url);
    }
    
    /**
     * generate the breadcrumb with all exiting breadcrumb items
     * 
     * @access public
     * @return string
     */
    public function getBreadcrumb(){
        $breadcrumb_items = array();
        
        $link = array();
        
        foreach(self::$breadcrumb as $item){
            list($title, $url) = $item;
            
            if($url == ''){
                $link[] = '<li>' . $title . '</li>';
            }else{
                $link[] = '<li><a href="{url}'. $url . '">' . $title . '</a></li>';
            }
            
            $breadcrumb_items = $link;
        }
        
        return implode('<span class="divider">></span>', $breadcrumb_items);
    }
}
?>
