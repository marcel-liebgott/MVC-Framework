<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * class for basic user data
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
class FW_User_Data{
	private $_id;
	private $_name;
	private $_pass;
	
	public function __construct($id, $name, $pass){
		$this->setId($id);
		$this->setName($name);
		$this->setPass($pass);
	}
	
	public function setId($id){
		if(FW_Validate::isInteger($id)){
			$this->_id = $id;
		}
	}
	
	public function getId(){
		return $this->_id;
	}
	
	public function setName($name){
		if(FW_Validate::isMixed($name)){
			$this->_name = $name;
		}
	}
	
	public function getName(){
		return $this->_name;
	}
	
	public function setPass($pass){
		$this->_pass = $pass;
	}
	
	public function getPass(){
		return $this->_pass;
	}
}
?>