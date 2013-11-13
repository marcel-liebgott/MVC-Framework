<?php 
  
if(!defined('PATH')){ 
    die("No direct script access allowed"); 
} 
  
/** 
 * Description of Validate 
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de> 
 * @since 1.00 
 * @package mvc 
 * @subpackage libs 
 */
  
class FW_Validate{ 
    /** 
     * handle system messages 
     *  
     * @access private 
     * @var FW_Messages 
     */
    private $msg; 
      
    /** 
     * load language values 
     *  
     * @access private 
     * @var FW_Language 
     */
    private $lang; 
      
    public function __construct(){ 
        $this->msg = FW_Registry::getInstance()->getMessages(); 
        $this->lang = FW_Registry::getInstance()->getLanguage(); 
    } 
      
    /** 
     * check the min length of an string 
     *  
     * @access public 
     * @param string $data 
     * @param int $arg 
     * @return boolean 
     */
    public function minLength($data, $arg){ 
        if(strlen($data) < $arg){ 
            $this->msg->setMessage($this->lang->getLangValue('min_length') . ' (' . $arg . ')', FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check the max length of an string 
     *  
     * @access public 
     * @param string $data 
     * @param int $arg 
     * @return boolean 
     */
    public function maxLength($data, $arg){ 
        if(strlen($data) > $arg){ 
            $this->msg->setMessage($this->lang->getLangValue('max_length') . ' (' . $arg . ')', FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check the data of his length 
     *  
     * @access public 
     * @param string $data 
     * @param int $arg 
     * @return boolean 
     */
    public function isLength($data, $arg){ 
        if(strlen($data) !== $arg){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_long') . ' (' . $arg . ')', FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an int 
     *  
     * @access public 
     * @param string $data 
     * @return boolean 
     */
    public function isInteger($data){ 
        if(!is_integer($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_a_integer'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an string 
     *  
     * @access public 
     * @param string $data 
     * @return boolean 
     */
    public function isString($data){ 
        if(!ctype_alpha($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_a_string'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an numeric 
     *  
     * @access public 
     * @param string $data 
     * @return boolean 
     */
    public function isNumeric($data){ 
        if(!is_numeric($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_a_numberic'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an float 
     *  
     * @access public 
     * @param string $data 
     * @return boolean 
     */
    public function isFloat($data){ 
        if(!is_float($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_a_float'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an bool 
     *  
     * @access public 
     * @param string $data 
     * @return boolean 
     */
    public function isBool($data){ 
        if(!is_bool($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_boolean'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an array 
     *  
     * @access public 
     * @param array $data 
     * @return boolean 
     */
    public function isArray($data){ 
        if(!is_array($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_a_array'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * checked if the input has an mixed value 
     *  
     * @access public 
     * @param mixed $data 
     */
    public function isMixed($data){ 
        if(!ctype_alnum($data)){ 
            $this->msg->setMessage($this->lang->getLangValue('must_be_mixed'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    /** 
     * delete all html and php entries in the string 
     *  
     * @access public 
     * @param string $string 
     * @return boolean 
     */
    public function filterHtmlInString($string){ 
        return strip_tags($string); 
    } 
      
    /** 
     *  
     * @param type $data 
     * @return boolean 
     */
    public function isValidMail($data){ 
        if(!filter_var($data, FILTER_VALIDATE_EMAIL)){ 
            $this->msg->setMessage($this->lang->getLangValue('mail_not_valid'), FW_Messages::_E_WARNING); 
              
            return false; 
        } 
          
        return true; 
    } 
      
    public function isValidUrl($data){ 
        if(!filter_var($data, FILTER_VALIDATE_URL)){ 
            $this->msg->setMessage($this->lang->getLangValue('url_not_valide'), FW_Messages::_E_WARNING); 
            return false; 
        } 
          
        return true; 
    } 
      
    public function __call($name, $arg){ 
    } 
} 
  
?>