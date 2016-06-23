<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * class to represenate an array
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
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
	 * constructor
	 * 
	 * @access public
	 * @param array $array
	 */
	public function __construct($array = array()){
		if(count($array) == 1){
			$array = $array[0];
		}
		
		$this->_array = $array;
	}
	
	/**
	 * destructor
	 * 
	 * @access public
	 */
	public function __destruct(){
		$this->_array = null;
	}
	
	/**
	 * append an array
	 * 
	 * @access public
	 * @param mixed $data
	 */
	public function add($data){
		if(is_array($data)){
			$keys = array_keys($data);
			
			foreach($keys as $key){
				$this->_array[$key] = $data[$key];
			}
		}else{
			$this->_array[] = $data;
		}
	}
	
	/**
	 * get the size of the array
	 * 
	 * @access public
	 * @return int
	 */
	public function size(){
		return count($this->_array);
	}
	
	/**
	 * get an array element based on a key
	 * 
	 * @access public
	 * @param mixed $needed
	 * @return mixed
	 */
	public function get($needed){
		$keys = array_keys($this->_array);
		
		foreach($keys as $key){
			if($key == $needed){
				return $this->_array[$key];
			}
		}
	}
	
	/**
	 * check if key exists
	 * 
	 * @access public
	 * @param Mixed $key
	 * @return boolean
	 */
	public function exists($key){
		$keys = array_keys($this->_array);
		
		foreach($keys as $key){
			if(key == $needed){
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * remove an array element by given key
	 * 
	 * @access public
	 * @param Mixed $key
	 */
	public function remove($key){
		$keys = array_keys($this->_array);
		
		foreach($keys as $key){
			if(key == $needed){
				unset($this->_array[$key]);
			}
		}
	}
}
?>
