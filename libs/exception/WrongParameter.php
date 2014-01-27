<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Exception_WrongParameter extends FW_Exception_Critical{
	public function __construct($data, $code = 0){
		$message = $data['message'];
		$arg = '';

		if(isset($data['arg']) && !empty($data['arg'])){
			$arg = ' (' . $data['arg'] . ')';
		}

		$registry = FW_Registry::getInstance();

		$lang = FW_Registry::getInstance()->getLanguage();

		$msg = $lang->getLangValue($message) . $arg;

		parent::__construct($message, $code);
	}
}
?>