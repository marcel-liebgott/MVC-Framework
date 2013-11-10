<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of FW_Language
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */

class FW_Language{
    private static $instance = null;
    private $langFile;
    private $langValues = array();
    
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FW_Language();
        }
        
        return self::$instance;
    }
    
    public function __construct(){
        //$config = FW_Registry::getInstance()->getConfiguration();
        
        $lang = FW_Session::get('lang');
        
        $file = LANG_DIR . $lang . '.ini';
        
        if(file_exists($file)){
            $this->langFile = $file;
            
            $this->loadLangIni();
        }else{
            //throw new FW_Exception("language file (" . $file . $lang . ") dosn't exists");
        }
    }
    
    /**
     * load all ini values into array
     * 
     * @access private
     */
    private function loadLangIni(){
        $val = parse_ini_file($this->langFile);
        
        foreach($val as $ident => $value){
            $this->langValues[$ident] = $value;
        }
    }
    
    /**
     * check if an ident exists
     * 
     * @access private
     * @param string $ident
     * @return boolean
     */
    private function existsIdent($ident){
        if(isset($this->langValues[$ident])){
            return true;
        }
        
        return false;
    }
    
    /**
     * returns the value of an language entry
     * 
     * @access public
     * @param string $ident
     * @return string|null
     */
    public function getLangValue($ident){
        if($this->existsIdent($ident) == true){
            return $this->langValues[$ident];
        }
        
        return null;
    }
    
    /**
     * convert all keys with the language value
     * 
     * @access public
     * @param array $array
     * @return array
     */
    public function convertKeyToLanuage($array){
        if(is_array($array)){
            $arr = array();
            
            for($i = 0; $i < count($array); $i++){
                if(isset($array[$i]['id']) && !empty($array[$i]['id'])){
                    unset($array[$i]['id']);
                }
                foreach($array[$i] as $key => $value){
                    $langValue = $this->getLangValue($key);

                    $arr[$i][] = array(
                        '0' => $langValue,
                        '1' => $value
                    );
                }
            }
            
            return $arr;
        }
    }
}

?>
