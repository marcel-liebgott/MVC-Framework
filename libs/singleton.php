<?php
/**
 * base class for all singletons
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 *
 * @codeCoverageIgnore
 */
abstract class FW_Singleton{
	/**
	 * all instances
	 *
	 * @access private
	 * @var array
	 */
	private static $_instances = array();

	private static $_locked = true;

	/**
	 * get a singleton instance
	 *
	 * @access protected
	 * @static
	 * @since 1.01
	 * @param string $class
	 * @return FW_Singleton
	 */
	protected static function _getInstance($class){
		if(!isset(self::$_instances[$class])){
			self::$_locked = false;
			self::$_instances[$class] = new $class();
			self::$_locked = true;
		}

		return self::$_instances[$class];
	}

	/**
	 * constructor
	 *
	 * @access protected
	 * @throws FW_Exception
	 */
	protected function __construct(){
		if(self::$_locked){
			throw new FW_Exception("Called class is a singleton class");
		}
	}
	
	private function __clone(){}

	public function __call($method, $args){}
	
	private function __weekup(){}
}
?>
