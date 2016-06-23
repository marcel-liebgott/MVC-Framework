<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * feed document which is presenting {@link FW_Feed_Item}s
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
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
	 * @var string
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
	 * @var string
	 */
	private $_link;
	
	/**
	 * version
	 * 
	 * @access private
	 * @var string
	 */
	private $_version;
	
	/**
	 * language
	 * 
	 * @access private
	 * @var string
	 */
	private $_language;
	
	/**
	 * description
	 * 
	 * @access private
	 * @var string
	 */
	private $_description;
	
	/**
	 * category
	 * 
	 * @access private
	 * @var string
	 */
	private $_category;
	
	/**
	 * item array
	 * 
	 * @access private
	 * @var array
	 */
	private $_items = array();
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @param string $title
	 * @param int $date
	 * @param string $encoding
	 */
	public function __construct($title, $date, $encoding = 'UTF-8'){
		$this->setTitle($title);
		$this->setDate($date);
		$this->setEncoding($encoding);
	}
	
	/**
	 * set title
	 * 
	 * @access public
	 * @param string $title
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
	 * @return string
	 */
	public function getTitle(){
		return $this->_title;
	}
	
	/**
	 * set date
	 * 
	 * @access public
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
	 * @return int
	 */
	public function getDate(){
		return $this->_date;
	}
	
	/**
	 * set encoding
	 * 
	 * @access public
	 * @param string $encoding
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
	 * @return string
	 */
	public function getEncoding(){
		return $this->_encoding;
	}
	
	/**
	 * set link
	 * 
	 * @access public
	 * @param string $link
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
	 * @return string
	 */
	public function getLink(){
		return $this->_link;
	}
	
	/**
	 * set version
	 * 
	 * @access public
	 * @param string $version
	 */
	public function setVersion($version){
		if(FW_Validate::isString($version)){
			$this->_version = $version;
		}
	}
	
	/**
	 * get version
	 * 
	 * @access public
	 * @return string
	 */
	public function getVersion(){
		return $this->_version;
	}
	
	/**
	 * set language
	 * 
	 * @access public
	 * @param string $language
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
	 * @return string
	 */
	public function getLanguage(){
		return $this->_language;
	}
	
	/**
	 * set description
	 * 
	 * @access public
	 * @param string $description
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
	 * @return string
	 */
	public function getDescription(){
		return $this->_description;
	}
	
	/**
	 * set category
	 *
	 * @access public
	 * @param string $category
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
	 * @return string
	 */
	public function getCategory(){
		return $this->_category;
	}
	
	/**
	 * add a item
	 * 
	 * @access public
	 * @param FW_Feed_Item $item
	 */
	public function addItem(FW_Feed_Item $item){
		$this->_items[] = $item;
	}
	
	/**
	 * get all {@see FW_Feed_Item}s
	 * 
	 * @access public
	 * @return array
	 */
	public function getItems(){
		return $this->_items;
	}
}
?>
