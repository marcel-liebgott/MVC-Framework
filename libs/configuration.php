<?php
/**
 * read config-ini file for application configuration
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @since 1.00
 */
class FW_Configuration extends FW_Singleton{
    /**
     * a array with all application configuration
     *
     * @access private
     * @var array
     */
    private $config = array();
    
    /**
     * get current singleton instance of this class
     *
     * @access public
     * @static
     * @return FW_Configuration
     */
    public static function getInstance(){        
        return parent::_getInstance(get_class());
    }
    
    /**
     * set a new config value
     *
     * @access public
     * @param string $key
     * @param string $value
     */
    public function setConfig($key, $value){
        if($key !== null && $value !== null){
            $key = FW_String::strtolower($key);
            $this->config[$key] = $value;
        }
    }
    
    /**
     * check if an configuration key exists
     *
     * @access private
     * @param string $key
     * @return boolean
     */
    private function issetKey($key){
        if(isset($this->config[$key])){
            return true;
        }
        
        return false;
    }
    
    /**
     * get an configuration value
     *
     * @access public
     * @param string $key
     * @return string
     */
    public function getConfig($key){
        if(FW_Validate::isString($key)){
            $key = FW_String::strtolower($key);

            if($this->issetKey($key)){
                return $this->config[$key];
            }
            
            return null;
        }
    }
    
    /**
     * read ini file
     *
     * @access public
     * @throws FW_Exception_MissingData
     * @param string $path
     */
    public function readIni($path){
        if(file_exists($path)){
            $ini = parse_ini_file($path);
            
            foreach($ini as $key => $value){
                $this->setConfig($key, $value);
            }
        }else{
            throw new FW_Exception_MissingData("can't find ini file (" . $path . ")");
        }
    }
}
?>
