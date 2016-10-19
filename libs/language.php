<?php
/**
 * Description of FW_Language
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */
class FW_Language extends FW_Singleton{

    /**
     * lang ini file
     *
     * @access private
     * @var string
     */
    private $langFile;

    /**
     * all lang keys with his value
     *
     * @access private
     * @var array
     */
    private $langValues = array();
    
    /**
     * get instance
     *
     * @access public
     * @static
     * @return FW_Singleton
     */
	public static function getInstance(){
        return parent::_getInstance(get_class());
    }
    
    
    /**
     * constructor
     *
     * @access public
     */
    public function __construct(){
    	parent::__construct();
    	
        $lang = FW_Session::get('lang');
        
        if($lang === null || $lang == ""){
        	$config = FW_Registry::getInstance()->getConfiguration();
        	
        	$lang = $config->getConfig('default_lang');
        }
        
        $file = LANG_DIR . $lang . '.ini';
        
        if(file_exists($file)){
            $this->langFile = $file;
            
            $this->loadLangIni();
        }else{
            throw new FW_Exception("language file (" . $file . ") dosn't exists");
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
     * @return string
     */
    public function getLangValue($ident){
    	$value = '';
        if($this->existsIdent($ident) === true){
            $value = $this->langValues[$ident];
        }
        
		return $value;
    }
    
    /**
     * convert all keys with the language value
     * 
     * @access public
     * @param array $array
     * @return array
     */
    public function convertKeyToLanguage($array){
        if(FW_Validate::isArray($array)){
            $arr = array();
            
            $count = count($array);
            
            for($i = 0; $i < $count; $i++){
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
