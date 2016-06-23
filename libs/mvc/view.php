<?php
if(!defined('PATH')){
    throw new FW_Exception_AccessDenied("No direct script access allowed");
}

/**
 * Description of View
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 */
class FW_Mvc_View extends FW_Mvc_ViewParser{
    private $template;
    private $class;
    
    private $templateFile;
    private $headerFile;
    private $footerFile;
    private $msgFile;
    
    private $if_regex = '#\{if\s+(.+?)\}\s*(.+?)\s*(?:\{else\}\s*(.+?))?\s*\{endif\}#s';
    private $for_regex = '#\{for\s+key=(.+?)\s+from=(.+?)\}\s*(.+?)\s*\{endfor\}#s';
    private $lang_regex = '#\{lang\s+(.+?)\s*\}#s';
    private $include_regex = '#\{include\s*(.+)\s*\"(.+)\"\}#s';
    //private $include_regex = '#\{include\s*(.+)\s*\"(.+)\"\s*(?:\s*(.+?))?\}#s';
    private $bbcode_regex = '#\{bbcode\}\s*(.+?)\s*\{endbbcode\}#s';
    
    /**
     * constructor
     * 
     * @access public
     * @param FW_Abstract_Controller $class
     */
    public function __construct($class){
        $this->class = $class;
        parent::__construct();
    }
    
    /**
     * render
     * 
     * @access public
     * @since 1.00
     * @param string $name
     * @param string $noInclude
     * @throws FW_Exception
     */
    public function render($name, $noInclude = false){
        $request = FW_Registry::getInstance()->getRequest();
        $url = $request->getUrl();

        if(strtolower($url[0]) === 'acp'){
            $dir = VIEW_DIR. ACP_DIR;
        }else{
            $dir = VIEW_DIR;
        }

        $this->templateFile = $dir . $name . '.php';
        
        if(!file_exists($this->templateFile)){
            throw new FW_Exception("template file dosn't exists");
        }
        
        $this->headerFile =  $dir . 'inc/header.php';
        $this->footerFile = $dir . 'inc/footer.php';
        $this->msgFile = $dir . 'inc/msg.php';
        
        $this->template = file_get_contents($this->headerFile);

        if(in_array('headline', $this->vars) && $this->vars['headline'] === true){
            $this->template .= file_get_contents($dir . 'inc/headline.php');
        }

        $this->template .= file_get_contents($this->templateFile);
        $this->template .= file_get_contents($this->footerFile);
        
        $this->renderInformation();
        $this->renderStatements();
        $this->assignVariables();
        $this->renderConst();
        
        if($noInclude === true){
            require_once 'views/' . $name . '.php';
        }else{
            echo $this->template;
        }
    }

    /**
     * hightlight php code
     * 
     * @access private
     * @since 1.00
     * @param array $matches
     * @return string
     */
    private function highlight_php($matches){
        $php = highlight_string($matches[0], true);

        //strip out the phptags
        $php = preg_replace("#(\[php\]|\[/php\])#i", "", $php);

        $php = '<div class="code">' . $php . '</div>';

        return $php;
    }
    
    /**
     * prerender all supported stuff
     * 
     * @access private
     */
    private function renderStatements(){
        // if
        $this->template = preg_replace_callback($this->if_regex, array(&$this, 'parseIfElse'), $this->template);
        
        // include
        $this->template = preg_replace_callback($this->include_regex, array(&$this, 'includeParse'), $this->template);
        
        // if
        $this->template = preg_replace_callback($this->if_regex, array(&$this, 'parseIfElse'), $this->template);
        
        // lang
        $this->template = preg_replace_callback($this->lang_regex, array(&$this, 'parseLang'), $this->template);
        
        // for
        $this->template = preg_replace_callback($this->for_regex, array(&$this, 'parseFor'), $this->template);
    }
    
    /**
     * render all given variables into the template
     * 
     * @access private
     */
    private function assignVariables(){
        if(count($this->vars) > 0){
            foreach($this->vars as $ident => $replace){
                if(FW_Validate::isArray($replace, false)){
                    foreach($replace as $key => $value){
                        $v = null;
                        
                        if(is_array($value)){
                            foreach($value as $val){
                                $v = $val;
                            }
                        }else{
                            $v = $value;
                        }
                        $tmp = $ident . '.' . $key;

                        $search = self::BEGIN_DELIMITER . self::VARIABLE_IDENT . $tmp . self::END_DELIMITER;
                        $this->template = $this->replace($search, $v, $this->template);
                    }
                }else{
                    $tmp = self::BEGIN_DELIMITER . self::VARIABLE_IDENT . $ident . self::END_DELIMITER;
                    $this->template = $this->replace($tmp, $replace, $this->template);
                }
            }
        }
    }
    
    /**
     * render some static informations into the template
     * 
     * @access private
     */
    private function renderInformation(){
        $fw_version = FW_Version::getFull();
        $footerInformation = '&copy; ' . date('Y') . ' Marcel Liebgott, Powered by <a href="http://www.mliebgott.de" target="_self">mliebgott.de</a> - Version: ' . $fw_version;

        $r_array = array(
            'fw_info' => $footerInformation,
            'version_info' => $fw_version
        );

        foreach($r_array as $ident => $replace){
            $search = self::BEGIN_DELIMITER . $ident . self::END_DELIMITER;
            $this->template = $this->replace($search, $replace, $this->template);
        }
    }
    
    /**
     * render all const
     * 
     * @access private
     */
    private function renderConst(){
        $db = FW_Registry::getInstance()->getDatabase();
        $lang = FW_Registry::getInstance()->getLanguage();
        
        if(@defined(CONFIG)){        
            $pagetitle = $db->select("SELECT " . PAGETITLE . " FROM " . CONFIG);
            
            if(count($pagetitle) > 0){
                $pagetitle = $pagetitle[0][PAGETITLE];
            }else{
                $pagetitle = $lang->getLangValue('title');
            }
        }else{
            $pagetitle = $lang->getLangValue('title');
        }

        $const = array(
            'url' => PATH,
            'msg' => $this->generateMessageArea(),
            'pagetitle' => $pagetitle
        );
        
        foreach($const as $ident => $value){
            $search = self::BEGIN_DELIMITER . $ident . self::END_DELIMITER;
            $this->template = $this->replace($search, $value, $this->template);
        }
    }
    
    /**
     * generate message area
     * 
     * @access private
     * @return mixed
     */
    private function generateMessageArea(){
        $msg = null;
        
        if($msg !== null && count($msg) > 0){
            $lang = FW_Registry::getInstance()->getLanguage();
            $msg_level = FW_String::strtolower($msg[0]);
            $msg_value = $msg[1];
            
            $msg_template = file_get_contents($this->msgFile);
            
            $s_level = self::BEGIN_DELIMITER . 'msg_level' . self::END_DELIMITER;
            $s_value = self::BEGIN_DELIMITER . 'msg_value' . self::END_DELIMITER;
            
            if($msg_level !== null){
            	$msg_level = $lang->getLangValue($msg_level);
            	
            	if($msg_level !== null){
	            	$msg_template = $this->replace($s_level, $msg_level, $msg_template);
	            	$msg_template = $this->replace($s_value, $msg_value, $msg_template);
            	}
            }
            
            return $msg_template;
        }
        
        return null;
    }
    
    /**
     * parse an for-statement
     * 
     * @access private
     * @param array $result
     * @return string
     */
    private function parseFor($result){        
        $key = $result[1];
        $from = $result[2];
        $c = null;
        $value = null;
        $tmp = null;
        
        if(in_array($from, array_keys($this->vars))){
            $value = $this->vars[$from];
            $tmp = $result[3];
        }
        
        if(is_array($value)){
            foreach($this->vars[$from] as $value){
                $tmp_s = $result[3];
                
                if(is_array($value)){
	                foreach($value as $k => $v){
	                    $find = self::BEGIN_DELIMITER . $key . '.' . $k . self::END_DELIMITER;
	                    $tmp_s = $this->replace($find, $v, $tmp_s);
	                }
	                $c .= $tmp_s;
                }
            }
        }else{
            $find = self::BEGIN_DELIMITER . $key . self::END_DELIMITER;
            $c = $this->replace($find, $value, $tmp);
        }
        
        return $c;
    }
    
    /**
     * parse an language statement
     * 
     * @access private
     * @param array $result
     * @return string
     */
    private function parseLang($result){
        return $this->replace($result[0], $this->lang->getLangValue($result[1]), $result[0]);
    }
}
?>

