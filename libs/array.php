<?php
/**
 * class to represenate an array
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
 */
final class FW_Array{
	/**
	 * @var FW_Array
	 */
	private $array;
	
	/**
	 * constructor
	 * 
	 * @access public
	 * @param FW_Array $array
	 */
	public function __construct($array = array()){
		if(count($array) == 1){
			$array = $array[0];
		}
		
		$this->array = $array;
	}
	
	/**
	 * destructor
	 * 
	 * @access public
	 */
	public function __destruct(){
		$this->array = null;
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
				$this->array[$key] = $data[$key];
			}
		}else{
			$this->array[] = $data;
		}
	}
	
	/**
	 * get the size of the array
	 * 
	 * @access public
	 * @return int
	 */
	public function size(){
		return count($this->array);
	}
	
	/**
	 * get an array element based on a key
	 * 
	 * @access public
	 * @param mixed $needed
	 * @return mixed
	 */
	public function get($needed){
		$keys = array_keys($this->array);
		
		foreach($keys as $key){
			if($key == $needed){
				return $this->array[$key];
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
		$keys = array_keys($this->array);
		
		foreach($keys as $key){
			if($key == $needed){
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
		$keys = array_keys($this->array);
		
		foreach($keys as $key){
			if(key == $needed){
				unset($this->array[$key]);
			}
		}
	}
}
?>
