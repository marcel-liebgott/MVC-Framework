<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of FW_ViewParser
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */
class FW_ViewParser{
    private $enableKindsOfIncludes = array('template' => 'views/');
    private $enableKindsOfElements = array('session:' => 'FW_Session', 'cookie:' => 'FW_Cookie');
    private $enableOperations = array('==', '>', '<', '>=', '<=', '!=');
    private $enabledConst = array('true' => true, 'false' => false);
    protected $msg;
    protected $lang;
    protected $vars = array();
    
    public function __construct(){
        $this->msg = FW_Messages::getInstance();
        $this->lang = FW_Language::getInstance();
    }
    
    /**
     * parse an include statement
     * 
     * @access protected
     * @param string $kindOfInclude
     * @param string $fileDir
     * @param string $fileName
     * @return string
     */
    protected function includeParse($result){
        $type = str_replace(' ', '', $result[1]);
        if(!in_array($type, array_keys($this->enableKindsOfIncludes))){
            $this->msg->setMessage('not supported kind of include', FW_Messages::_E_ERROR);
            return;
        }
        
        // exists file
        $templateFile = $this->enableKindsOfIncludes[$type] . $result[2] . '.php';
        
        if(!file_exists($templateFile)){
            $this->msg->setMessage("can't find template file<br>" . $templateFile, FW_Messages::_E_ERROR);
            return;
        }
        
        return file_get_contents($templateFile);
    }
    
    /**
     * replace an language ident
     * 
     * @access protected
     * @param string $found
     * @return string
     */
    protected function languageParse($found){
        return $this->lang->getLangValue($found);
    }
    
    /**
     * add variables who replace to
     * 
     * @access public
     * @param array $vars
     */
    public function addVariables(array $vars){
        $keys = array_keys($vars);
        
        if(array_search('headline', $keys) == false){
            $this->vars = array_merge($this->vars, array('headline' => true));
        }
        
        if(array_search('footer', $keys) == false){
            $this->vars = array_merge($this->vars, array('footer' => true));
        }
        
        $tmp_var = array_merge($this->vars, $vars);
        $this->vars = $tmp_var;
    }
    
    /**
     * parse an if statement and compare the condition
     * 
     * @access protected
     * @param array $result
     * @return string
     */
    protected function parseIfElse($result){
        $condition = false;
        $con = null;
        preg_match_all('/(.*):(.*)\s+(.*)\s+(.*)/i', $result[1], $if_else_match);
        
        if(count($if_else_match[0]) > 0){
            $search = $if_else_match[1][0] . ':';
            if(in_array($search, array_keys($this->enableKindsOfElements))){                
                $class = $this->enableKindsOfElements[$search];
                    
                $value = $class::get($if_else_match[2][0]);
                
                $con = str_replace($search . $if_else_match[2][0], "'$value'", $if_else_match[0][0]);
            }else{
                throw new FW_Exception("not supported template instance: " . $if_else_match[1][0]);
            }
        }
        
        preg_match_all('/\$(.*)\s+(.*)\s+(.*)/i', $result[1], $var_match);
        
        if(count($var_match[0]) > 0){
            $var_arr = explode('.', $var_match[1][0]);

            // array element wanted
            if(count($var_arr) > 0){
                if(in_array($var_arr[0], array_keys($this->vars))){
                    $val = $this->vars[$var_arr[0]];
                    $value = null;
                    
                    if(is_array($val)){
                        if(in_array($var_arr[1], array_keys($val))){
                            $value = $val[$var_arr[1]];
                        }else{
                            throw new FW_Exception("variable (" . $var_arr[1] . ") not in array of " . $var_arr[0]);
                        }
                    }else{
                        $value = $val;
                    }
                    
                    $con = str_replace("$" . $var_match[1][0], "'$value'", $var_match[0][0]);
                }
            }
        }
        
        if(!empty($con)){
            eval('$condition = ' . $con . ';');
            
            if($condition){
                return $result[2];
            }else{
                if(isset($result[3])){
                    return $result[3];
                }else{
                    return '';
                }
            }
        }
    }
}

?>
