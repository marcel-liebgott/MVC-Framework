<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * wrong argument exception
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.00
 */
final class FW_Exception_WrongParameter extends FW_Exception_Critical{
	/**
	 * constructor
	 * 
	 * @access public
	 * @param array $data
	 * @param int $code
	 */
	public function __construct($data, $code = 0){
		if(isset($data['message'])){
			$message = $data['message'];
		}
		
		$arg = '';

		if(isset($data['arg']) && !empty($data['arg'])){
			$arg = ' (' . $data['arg'] . ')';
		}

		$registry = FW_Registry::getInstance();
		$lang = $registry->getLanguage();
		
		if($lang != null){
			$lang_value = $lang->getLangValue($message);
			
			$msg = $lang_value . $arg;
		}else{
			$msg = "";
		}

		parent::__construct($msg, $code);
	}
}
?>
