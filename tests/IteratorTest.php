<?php
include_once '../libs/array.php';
include_once '../libs/iterator.php';

class IteratorTest extends PHPUnit_Framework_TestCase{
	private $arrayData = array(1,2,3,4,5,6,7,8,9,0);
	private $array;
	private $iter;
	
	public function setUp(){
		$this->array = new FW_Array($this->arrayData);
		$this->iter = $this->array->getIterator();
	}
	
	public function test_startIndex(){
		$this->assertEquals(0, $this->iter->key());
	}
	
	public function test_getLastIndex(){
		$size = $this->array->size();
		$this->iter->rewind();
		
		while($this->iter->valid()){
			$this->iter->next();
		}
		
		$this->assertEquals($size, $this->iter->key());
	}
}
?>