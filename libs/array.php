<?php
/**
 * class to represenate an array
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
 */
final class FW_Array implements Countable{
	/**
	 * @access private
	 * @var FW_Array
	 */
	private $array = array();
	
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
		$this->add($array);
		$this->iterator = new FW_Iterator($this->array);
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
			$this->array = array_merge($this->array, $data);
		}else{
			$this->array = array_merge($this->array, array($data));
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
	 * get the size of the array
	 *
	 * @access public
	 * @return int
	 */
	public function count() : int{
		return $this->size();
	}
	
	/**
	 * get an array element based on a key
	 * 
	 * @access public
	 * @param mixed $needed
	 * @return mixed
	 */
	public function get($needed){
		if($this->array !== null && count($this->array) > 0 && $this->exists($needed)){
			$keys = array_values($this->array);
			
			foreach($keys as $key){
				if($key == $needed){
					return $this->array[$key];
				}
			}
		}
		
		return null;
	}
	
	/**
	 * check if value exists
	 * 
	 * @access public
	 * @param mixed $key
	 * @return boolean
	 */
	public function exists($key) : bool{
		$keys = array_values($this->array);
		
		foreach($keys as $_key){
			if($_key == $key){
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * check if key exists
	 *
	 * @access public
	 * @param mixed $key
	 * @return boolean
	 */
	public function existsKey($key) : bool{
		$keys = array_keys($this->array);
	
		foreach($keys as $_key){
			if($_key == $key){
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
		
		foreach($keys as $_key){
			if($_key == $key){
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
