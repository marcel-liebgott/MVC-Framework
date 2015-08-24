<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * class to represenate an array
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
final class FW_Array{
	/**
	 * array
	 * 
	 * @access private
	 * @var array
	 */
	private $_array;
	
	/**
	 * array iterator
	 * 
	 * @access private
	 * @var ArrayIterator
	 */
	private $_iterator;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @param Array $array
	 */
	public function __construct($array = array()){
		$this->_array = new ArrayObject($array);
		$this->_iterator = $this->_array->getIterator();
	}
	
	/**
	 * get the iterator of this array
	 * 
	 * @access public
	 * @since 1.01
	 * @return ArrayIterator
	 */
	public function getIterator(){
		return $this->_iterator;
	}
	
	/**
	 * append an array
	 * 
	 * @access public
	 * @since 1.01
	 * @param mixed $data
	 */
	public function add($data){
		if(is_array($data)){
			$keys = array_keys($data);
			
			foreach($keys as $key){
				$this->_array[$key] = $data[$key];
			}
		}else{
			$this->_array->append($data);
		}
	}
	
	/**
	 * get the size of the array
	 * 
	 * @access public
	 * @since 1.01
	 * @return int
	 */
	public function size(){
		return $this->_iterator->count();
	}
	
	/**
	 * get an array element based on a key
	 * 
	 * @access public
	 * @since 1.01
	 * @param mixed $key
	 * @return mixed
	 */
	public function get($key){
		while($this->_iterator->valid()){
			if($this->_iterator->key() === $key){
				return $this->_iterator->current();
			}
			
			$this->_iterator->next();
		}
	}
}
?>