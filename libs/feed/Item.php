<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * a feed item
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
 */
final class FW_Feed_Item{
	/**
	 * the title
	 * 
	 * @access private
	 * @var String
	 */
	private $_title;
	
	/**
	 * the link
	 * 
	 * @access private
	 * @var String
	 */
	private $_link;
	
	/**
	 * the descripttion
	 * 
	 * @access private
	 * @var String
	 */
	private $_description;
	
	/**
	 * the author
	 * 
	 * @access private
	 * @var String
	 */
	private $_author;
	
	/**
	 * the date (timestamp)
	 * 
	 * @access private
	 * @var int
	 */
	private $_date;
	
	/**
	 * the comments
	 * 
	 * @access private
	 * @var String
	 */
	private $_comment;
	
	/**
	 * the category
	 * 
	 * @access private
	 * @var String
	 */
	private $_category;
	
	/**
	 * the unique id
	 * 
	 * @access private
	 * @var String
	 */
	private $_guid;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.01
	 * @param String $guid
	 * @param String $title
	 * @param String $description
	 * @param int $date
	 * @param String $link
	 * @param String $author
	 * @param String $category
	 * @param String $comment
	 */
	public function __construct($guid, $title, $description, $date, $link, $author, $category, $comment){
		$this->setGuid($guid);
		$this->setTitle($title);
		$this->setDescription($description);
		$this->setDate($date);
		$this->setLink($link);
		$this->setAuthor($author);
		$this->setCategory($category);
		$this->setComment($comment);
	}
	
	/**
	 * set title
	 * 
	 * @access public
	 * @param String $title
	 */
	public function setTitle($title){
		if(FW_Validate::isString($title)){
			$this->_title = $title;
		}
	}
	
	/**
	 * get title
	 * 
	 * @access public
	 * @return String
	 */
	public function getTitle(){
		return $this->_title;
	}
	
	/**
	 * set link
	 * 
	 * @access public
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
	 * @return String
	 */
	public function getLink(){
		return $this->_link;
	}
	
	/**
	 * set description
	 *
	 * @access public
	 * @param String $desc
	 */
	public function setDescription($desc){
		if(FW_Validate::isString($desc)){
			$this->_description = $desc;
		}
	}
	
	/**
	 * get decription
	 * 
	 * @access public
	 * @return String
	 */
	public function getDescription(){
		return $this->_description;
	}
	
	/**
	 * set author
	 * 
	 * @access public
	 * @param String $author
	 */
	public function setAuthor($author){
		if(FW_Validate::isString($author)){
			$this->_author = $author;
		}
	}
	
	/**
	 * get author
	 * 
	 * @access public
	 * @return String
	 */
	public function getAuthor(){
		return $this->_author;
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
	 * set link to comment
	 * 
	 * @access public
	 * @param String $comment
	 */
	public function setComment($comment){
		if(FW_Validate::isValidUrl($comment)){
			$this->_comment = $comment;
		}
	}
	
	/**
	 * get comment link
	 * 
	 * @access public
	 * @return String
	 */
	public function getComment(){
		return $this->_comment;
	}
	
	/**
	 * set category
	 * 
	 * @access public
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
	 * @return String
	 */
	public function getCategory(){
		return $this->_category;
	}
	
	/**
	 * set guid
	 * 
	 * @access public
	 * @param mixed $guid
	 */
	public function setGuid($guid){
		if(FW_Validate::isMixed($guid)){
			$this->_guid = $guid;
		}
	}
	
	/**
	 * get guid
	 * 
	 * @access public
	 * @return mixed
	 */
	public function getGuid(){
		return $this->_guid;
	}
}
?>
