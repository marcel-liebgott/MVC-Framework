<?php
if(!defined('PATH')){
    throw new FW_Exception_AccessDenied("No direct script access allowed");
}

/**
 * Description of View
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @package libs.mvc
 * @since 1.00
 */
class FW_Mvc_View extends FW_Object{
	private $useHeadline = true;
	private $useFooter = true;
	
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

    private $enableKindsOfIncludes = array('template' => 'views/');
    private $enableKindsOfElements = array('session:' => 'FW_Session', 'cookie:' => 'FW_Cookie');
    private $enableOperations = array('==', '>', '<', '>=', '<=', '!=');
    private $enabledConst = array('true' => true, 'false' => false);

    protected $msg;
    protected $lang;
    protected $vars = array();

    const BEGIN_DELIMITER = '{';
    const END_DELIMITER = '}';
    const VARIABLE_IDENT = '$';
    
    /**
     * constructor
     * 
     * @access public
     * @param FW_Abstract_Controller $class
     */
    public function __construct($class){
		parent::__construct();
		
        $this->class = $class;

        $this->lang = FW_Registry::getInstance()->getLanguage();
    }
	
	/**
	 * set the headline property of this page
	 *
	 * @access public
	 * @param boolean $headline
	 * @throws FW_Exception_WrongParameter
	 */
	public function setUseHeadline($headline){
		if(!FW_Validate::isBoolean($headline)){
			throw new FW_Exception_WrongParameter("use header must be an boolean");
		}
		
		$this->useHeadline = $headline;
	}
	
	/**
	 * if the page needed a headline
	 *
	 * @access public
	 * @return boolean
	 */
	public function useHeadline(){
		return $this->useHeadline;
	}
	/**
	 * set the footer property of this page
	 *
	 * @access public
	 * @param boolean $footer
	 * @throws FW_Exception_WrongParameter
	 */
	public function setUseFooter($footer){
		if(!FW_Validate::isBoolean($footer)){
			throw new FW_Exception_WrongParameter("use header must be an boolean");
		}
		
		$this->useFooter = $footer;
	}
	
	/**
	 * if the page needed a footer
	 *
	 * @access public
	 * @return boolean
	 */
	public function useFooter(){
		return $this->useFooter;
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
        
		$this->msgFile = $dir . 'inc/msg.php';
		
		$this->headerFile =  $dir . FW_TPL_HEADER;
        $this->template = file_get_contents($this->headerFile);

        if($this->useHeadline()){
            $this->template .= file_get_contents($dir . FW_TPL_HEADLINE);
        }

        $this->template .= file_get_contents($this->templateFile);
		
		if($this->useFooter()){
			$this->footerFile = $dir . 'inc/footer.php';
			$this->template .= file_get_contents($this->footerFile);
		}
        
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

    /**
     * replace a string in a string
     * 
     * @access private
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    protected function replace($search, $replace, $subject){
        return str_replace($search, $replace, $subject);
    }
    
    /**
     * parse an include statement
     * 
     * @access protected
     * @param array $result
     * @return mixed
     */
    protected function includeParse($result){
        $type = str_replace(' ', '', $result[1]);
        if(!in_array($type, array_keys($this->enableKindsOfIncludes))){
            $this->msg->setMessage('not supported kind of include', FW_Messages::_E_ERROR);
            return null;
        }
        
        // exists file
        $templateFile = $this->enableKindsOfIncludes[$type] . $result[2] . '.php';
        
        if(!file_exists($templateFile)){
            $this->msg->setMessage("can't find template file<br>" . $templateFile, FW_Messages::_E_ERROR);
            return null;
        }

        $content = file_get_contents($templateFile);

        if(isset($result[3])){
            foreach($this->vars[$result[3]] as $key => $value){
                $content = $this->replace(self::BEGIN_DELIMITER . self::VARIABLE_IDENT . $key . self::END_DELIMITER, $value, $content);
            }
        }
        
        return $content;
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
        
        if(array_search('headline', $keys) === false){
            $this->vars = array_merge($this->vars, array('headline' => true));
        }
        
        if(array_search('footer', $keys) === false){
            $this->vars = array_merge($this->vars, array('footer' => true));
        }
        
        $tmp_var = array_merge($this->vars, $vars);
        $this->vars = $tmp_var;
    }
    
    /**
     * parse an if statement and compare the condition
     * 
     * @access protected
     * @throws FW_Exception
     * @param array $result
     * @return string
     */
    protected function parseIfElse($result){
        $condition = false;
        $con = null;
        $if_else_match = array();
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
        
        $var_match = array(); 
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

