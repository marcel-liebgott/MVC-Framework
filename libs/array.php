<?php
/**
 * class to represenate an array
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
 */
final class FW_Array{
	/**
	 * @access private
	 * @var FW_Array
	 */
	private $array;
	
	/**
	 * @access private
	 * @var FW_Iterator
	 * @since 1.01
	 */
	private $iterator;
	
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
		$this->iterator = new FW_Iterator($this->data);
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
	public function size() : int{
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
		if($this->array !== null && count($this->array) > 0){
			$keys = array_keys($this->array);
			
			foreach($keys as $key){
				if($key == $needed){
					return $this->array[$key];
				}
			}
		}
		
		return null;
	}
	
	/**
	 * check if key exists
	 * 
	 * @access public
	 * @param mixed $key
	 * @return boolean
	 */
	public function exists($key) : bool{
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
	 * @param mixed $key
	 */
	public function remove($key){
		$keys = array_keys($this->array);
		
		foreach($keys as $key){
			if($key == $needed){
				unset($this->array[$key]);
			}
		}
	}
	
	/**
	 * return data as array
	 * 
	 * @access public
	 * @since 1.01
	 * @return array
	 */
	public function asArray() : array{
		return $this->array;
	}
	
	/**
	 * return the current array iterator
	 * 
	 * @access public
	 * @return FW_Iterator
	 * @since 1.01
	 */
	public function getIterator() : FW_Iterator{
		return $this->iterator;
	}
}
?>
