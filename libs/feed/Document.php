<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * feed document which is presenting {@link FW_Feed_Item}s
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 * @final
 */
final class FW_Feed_Document{
	/**
	 * encoding
	 * 
	 * @access private
	 * @var String
	 */
	private $_encoding;
	
	/**
	 * title
	 * 
	 * @access private
	 * @var String
	 */
	private $_title;
	
	/**
	 * date (timestamp)
	 * 
	 * @access private
	 * @var int
	 */
	private $_date;
	
	/**
	 * link
	 * 
	 * @access private
	 * @var String
	 */
	private $_link;
	
	/**
	 * version
	 * 
	 * @access private
	 * @var String
	 */
	private $_version;
	
	/**
	 * language
	 * 
	 * @access private
	 * @var String
	 */
	private $_language;
	
	/**
	 * description
	 * 
	 * @access private
	 * @var String
	 */
	private $_description;
	
	/**
	 * category
	 * 
	 * @access private
	 * @var String
	 */
	private $_category;
	
	/**
	 * item array
	 * 
	 * @access private
	 * @var array
	 */
	private $_items = array();
	
	public function __construct($title, $date, $encoding = 'UTF-8'){
		$this->setTitle($title);
		$this->setDate($date);
		$this->setEncoding($encoding);
	}
	
	/**
	 * set title
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $title
	 */
	public function setTitle($title){
		if(FW_Validate::isString($title)){
			$this->_title = $title;
		}
	}
	
	/**
	 * return title
	 * 
	 * @access public
	 * @since 1.01
	 * @return String
	 */
	public function getTitle(){
		return $this->_title;
	}
	
	/**
	 * set date
	 * 
	 * @access public
	 * @since 1.01
	 * @param int $date
	 */
	public function setDate($date){
		if(FW_Validate::isInteger($date)){
			$this->_date = $date;
		}
	}
	
	/**
	 * get date
	 * 
	 * @access public
	 * @since 1.01
	 * @return int
	 */
	public function getDate(){
		return $this->_date;
	}
	
	/**
	 * set encoding
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $encoding
	 */
	public function setEncoding($encoding){
		if(FW_Validate::isString($encoding)){
			$this->_encoding = $encoding;
		}
	}
	
	/**
	 * get encoding
	 * 
	 * @access public
	 * @since 1.01
	 * @return String
	 */
	public function getEncoding(){
		return $this->_encoding;
	}
	
	/**
	 * set link
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $link
	 */
	public function setLink($link){
		if(FW_Validate::isValidUrl($link)){
			$this->_link = $link;
		}
	}
	
	/**
	 * get link
	 * 
	 * @access public
	 * @since 1.01
	 * @return String
	 */
	public function getLink(){
		return $this->_link;
	}
	
	/**
	 * set version
	 * 
	 * @access public
	 * @since 1.01
	 * @param Float $version
	 */
	public function setVersion($version){
		if(FW_Validate::isFloat($version)){
			$this->_version = $version;
		}
	}
	
	/**
	 * get version
	 * 
	 * @access public
	 * @since 1.01
	 * @return Float
	 */
	public function getVersion(){
		return $this->_version;
	}
	
	/**
	 * set language
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $language
	 */
	public function setLanguage($language){
		if(FW_Validate::isString($language)){
			$this->_language = $language;
		}
	}
	
	/**
	 * get language
	 * 
	 * @access public
	 * @since 1.01
	 * @return String
	 */
	public function getLanguage(){
		return $this->_language;
	}
	
	/**
	 * set description
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $description
	 */
	public function setDescription($description){
		if(FW_Validate::isString($description)){
			$this->_description = $description;
		}
	}
	
	/**
	 * get description
	 * 
	 * @access public
	 * @since 1.01
	 * @return String
	 */
	public function getDescription(){
		return $this->_description;
	}
	
	/**
	 * set category
	 *
	 * @access public
	 * @since 1.01
	 * @param String $category
	 */
	public function setCategory($category){
		if(FW_Validate::isString($category)){
			$this->_category = $category;
		}
	}
	
	/**
	 * get category
	 *
	 * @access public
	 * @since 1.01
	 * @return String
	 */
	public function getCategory(){
		return $this->_category;
	}
	
	/**
	 * add a item
	 * 
	 * @access public
	 * @since 1.01
	 * @param FW_Feed_Item $item
	 */
	public function addItem(FW_Feed_Item $item){
		$this->_items[] = $item;
	}
	
	/**
	 * get all {@see FW_Feed_Item}s
	 * 
	 * @access public
	 * @since 1.01
	 * @return array
	 */
	public function getItems(){
		return $this->_items;
	}
}
?>