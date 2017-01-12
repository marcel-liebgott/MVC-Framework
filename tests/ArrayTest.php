<?php
class ArrayTest extends PHPUnit_Framework_TestCase{
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
	
	public function test_arraySize(){
		$this->array = new FW_Array($this->arrayData);
		
		$this->assertEquals(10, $this->array->size());
		$this->assertEquals(10, $this->array->count());
	}
	
	public function test_arrayAddElement(){
		$this->array = new FW_Array($this->arrayData);
		$add = "test";
		
		$this->array->add($add);
		
		$this->assertTrue($this->array->exists($add));
	}
	
	public function test_arrayAddArrayElement(){
		$this->array = new FW_Array($this->arrayData);
		$add = array("test","test2");
	
		$this->array->add($add);
	
		$this->assertTrue($this->array->exists("test"));
	}
	
	public function test_arrayGetElement(){
		$this->array = new FW_Array($this->arrayData);
		$this->assertEquals(5, $this->array->get(4));
		$this->assertEquals(null, $this->array->get(11));
	}
	
	public function test_arrayRemoveElement(){
		$this->array = new FW_Array($this->arrayData);
		$this->array->remove(4);
		
		$this->assertFalse($this->array->exists(4));
	}
	
	public function test_arraySingleElement(){
		$array = new FW_Array(array("test"));
		
		$this->assertEquals(1, $array->size());
	}

	public function test_asArray(){
		$array = new FW_Array($this->arrayData);

		$this->assertInternalType('array', $array->asArray());
	}
}
?>