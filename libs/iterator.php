<?php
/**
 * iterator class to iterate above a collection
 * 
 * @author Marcel Liebgott (marcel@mliebgott.de)
 * @since 1.01
 */
class FW_Iterator implements Iterator{
	/**
	 * @access private
	 * @var array
	 * @since 1.01
	 */
	private $data;
	
	/**
	 * @access private
	 * @var integer
	 * @since 1.01
	 */
	private $idx = 0;
	
	public function __construct(&$data){
		$this->data = $data;
	}
	
	/**
	 * return the current element
	 * 
	 * @access public
	 * @return mixed
	 * @since 1.01
	 */
	public function current(){
		return $this->data[$this->idx];
	}
	
	/**
	 * move forward to the next element
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function next(){
		$this->idx++;
	}
	
	/**
	 * return the key of the current element
	 *
	 * @access public
	 * @return int
	 * @since 1.01
	 */
	public function key(){
		return $this->idx;
	}
	
	/**
	 * checks if the current position is valid
	 */
	public function valid(){
		return isset($this->data[$this->idx]);
	}
	
	/**
	 * rewind the iterator to the first element
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function rewind(){
		$this->idx = 0;
	}
	
	/**
	 * reverse the collection
	 * 
	 * @access public
	 * @since 1.01
	 */
	public function reverse(){
		$this->data = array_reverse($this->data);
		$this->rewind();
	}
}
?>
