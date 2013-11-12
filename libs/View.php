<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of View
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */

class FW_View extends FW_ViewParser{
    private $template;
    private $class;
    private $log;
    
    private $templateFile;
    private $headerFile;
    private $footerFile;
    private $msgFile;
    
    const BEGIN_DELIMITER = '{';
    const END_DELIMITER = '}';
    const VARIABLE_IDENT = '$';
    
    private $if_regex = '#\{if\s+(.+?)\}\s*(.+?)\s*(?:\{else\}\s*(.+?))?\s*\{endif\}#s';
    private $for_regex = '#\{for\s+key=(.+?)\s+from=(.+?)\}\s*(.+?)\s*\{endfor\}#s';
    private $lang_regex = '#\{lang\s+(.+?)\s*\}#s';
    private $include_regex = '#\{include\s*(.+)\s*\"(.+)\"\}#s';
    private $bbcode_regex = '#\{bbcode\}\s*(.+?)\s*\{endbbcode\}#s';
    
    public function __construct($class){
        $this->class = $class;
        $this->log = FW_Registry->getInstance();
        parent::__construct();
    }
    
    public function render($name, $noInclude = false){
        $request = FW_Registry::getInstance()->getRequest();
        $url = $request->getUrl();

        if(strtolower($url[0]) === 'acp'){
            $dir = VIEW_DIR. ACP_DIR;
        }else{
            $dir = VIEW_DIR;
        }

        $this->templateFile = 'views/' . $name . '.php';
        
        if(!file_exists($this->templateFile)){
            throw new FW_Exception("template file dosn't exists");
        }
        
        $this->headerFile =  $dir . 'inc/header.php';
        $this->footerFile = $dir . 'inc/footer.php';
        $this->msgFile = $dir . 'inc/msg.php';
        
        $this->template = file_get_contents($this->headerFile);
        $this->template .= file_get_contents($this->templateFile);
        $this->template .= file_get_contents($this->footerFile);
        
        $this->renderStatements();
        $this->assignVariables();
        $this->renderConst();
        $this->renderInformation();
        
        if($noInclude == true){
            require_once 'views/' . $name . '.php';
        }else{
            echo $this->template;
        }
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
        
        // bbcode
        $this->template = preg_replace_callback($this->bbcode_regex, array(&$this, 'parseBBCode'), $this->template);
    }
    
    /**
     * render all given variables into the template
     * 
     * @access private
     */
    private function assignVariables(){
        if(count($this->vars) > 0){
            foreach($this->vars as $ident => $replace){                
                if(is_array($replace)){
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
     * replace a string in a string
     * 
     * @access private
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    private function replace($search, $replace, $subject){        
        return str_replace($search, $replace, $subject);
    }
    
    /**
     * render some static informations into the template
     * 
     * @access private
     */
    private function renderInformation(){
        $footerInformation = base64_decode('JmNvcHk7IDIwMTMgTWFyY2VsIExpZWJnb3R0==');

        $r_array = array(
            'fw_info' => $footerInformation,
            'version_info' => VERSION
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
        $breakcrumb = FW_Breadcrumb::getInstance();
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
            'breadcrumb' => $breakcrumb->getBreadcrumb(),
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
        $msg = FW_Registry::getInstance()->getMessages();
        $msg = $msg->getMessage();
        
        if(count($msg) > 0){
            $lang = FW_Registry::getInstance()->getLanguage();
            $msg_level = strtolower($msg[0]);
            $msg_value = $msg[1];
            
            $msg_template = file_get_contents($this->msgFile);
            
            $s_level = self::BEGIN_DELIMITER . 'msg_level' . self::END_DELIMITER;
            $s_value = self::BEGIN_DELIMITER . 'msg_value' . self::END_DELIMITER;
            
            $msg_template = $this->replace($s_level, $lang->getLangValue($msg_level), $msg_template);
            $msg_template = $this->replace($s_value, $msg_value, $msg_template);
            
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
     * @throws FW_Exception
     */
    private function parseFor($result){
        if(count($result) != 4){
            $this->log->addLog("somethink wrong with your for-statement (for)", $this->class);
        }
        
        $key = $result[1];
        $from = $result[2];
        $c = null;
       
        if(!in_array($from, array_keys($this->vars))){
            $this->log->addLog("no variable to replace (" . $from . ")", $this->class);
        }
        
        if(!in_array($from, array_keys($this->vars))){
            $value = $this->vars[$from];
            $tmp = $result[3];
        }else{
            $this->log->addLog("Can't find source of the replacement (" . $from . ")"))
        }
        
        $tmp = $result[3];
        
        if(is_array($value)){
            foreach($this->vars[$from] as $ident => $value){
                $tmp_s = $result[3];
                
                foreach($value as $k => $v){
                    $find = self::BEGIN_DELIMITER . $key . '.' . $k . self::END_DELIMITER;
                    $tmp_s = $this->replace($find, $v, $tmp_s);
                }
                $c .= $tmp_s;
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
    
    /**
     * parse all smileys in a {bbcode}...{endbbcode} area
     * 
     * @access private
     * @param array $result
     * @return string
     */
    private function parseBBCode($result){
        $str = $result[1];
        
        $quote_tag = '<div style="border: solid 1px black; margin-left: 5px; margin-right: 5px;"><div style="background: #ccc"><b>Zitat</b></div>
            <div style="width:100%;">$1</div></div>';
        
        $str = preg_replace('/\[b\]\s*(.+)\[\/b\]/iUs', '<b>$1</b>', $str);
        $str = preg_replace('/\[k\]\s*(.+)\[\/k\]/iUs', '<i>$1</i>', $str);
        $str = preg_replace('/\[u\]\s*(.+)\[\/u\]/iUs', '<i>$1</i>', $str);
        $str = preg_replace('/\[left\]\s*(.+)\[\/left\]/iUs', '<div align="left" id="bbcode_left">$1</div>', $str);
        $str = preg_replace('/\[left\]\s*(.+)\[\/left\]/iUs', '<div align="center" id="bbcode_center">$1</div>', $str);
        $str = preg_replace('/\[left\]\s*(.+)\[\/left\]/iUs', '<div align="right" id="bbcode_right">$1</div>', $str);
        $str = preg_replace('/\[quote\](.*)\[\/quote\]/iUs', $quote_tag, $str);
        $str = preg_replace('/\[img\]\s*(.+)\[\/img\]/iUs', '<img src="$1">', $str);
        $str = preg_replace('/\[url\s*(.+)\]\s*(.+)\[\/url\]/iUs', '<a href="$1">$2</a>', $str);
        $str = preg_replace('/\[mail\s*(.+)\]\s*(.+)\[\/mail\]/iUs', '<a href="mailto:$1">$2</a>', $str);
        
        $str = preg_replace('/\s*:-D\s*/iUs', '<img src="public/images/smileys/bigsmile.png">', $str);
        $str = preg_replace('/\s*%\)\s*/iUs', '<img src="public/images/smileys/confused.png">', $str);
        $str = preg_replace('/\s*8-\)\s*/iUs', '<img src="public/images/smileys/cool.png">', $str);
        $str = preg_replace('/\s*:\'\(\s*/iUs', '<img src="public/images/smileys/crying.png">', $str);//
        $str = preg_replace('/\s*:-\(\s*/iUs', '<img src="public/images/smileys/frown.png">', $str);
        $str = preg_replace('/\s*:-p\s*/iUs', '<img src="public/images/smileys/tongue.png">', $str);
        $str = preg_replace('/\s*;-\)\s*/iUs', '<img src="public/images/smileys/wink.png">', $str);
        $str = preg_replace('/\s*:-0\s*/iUs', '<img src="public/images/smileys/biggrin.png">', $str);
        $str = preg_replace('/\s*:-o\s*/iUs', '<img src="public/images/smileys/eek.png">', $str);
        $str = preg_replace('/\s*:evil:\s*/iUs', '<img src="public/images/smileys/evil.png">', $str);
        $str = preg_replace('/\s*0:-\)\s*/iUs', '<img src="public/images/smileys/happy.png">', $str);
        $str = preg_replace('/\s*=\)\s*/iUs', '<img src="public/images/smileys/holy.png">', $str);
        $str = preg_replace('/\s*:ops:\s*/iUs', '<img src="public/images/smileys/oops.png">', $str);
        $str = preg_replace('/\s*:roll:\s*/iUs', '<img src="public/images/smileys/rolleyes.png">', $str);
        $str = preg_replace('/\s*oO\)\s*/iUs', '<img src="public/images/smileys/shock.png">', $str);
        $str = preg_replace('/\s*:-\/\s*/iUs', '<img src="public/images/smileys/unsure.png">', $str);
        
        return $str;
    }
}

?>
