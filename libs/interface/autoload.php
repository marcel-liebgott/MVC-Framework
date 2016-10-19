<?php
/**
 * interface for autoload implementation
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 */
interface FW_Interface_Autoload{
  /**
   * register an autoloader
   *
   * @access public
   */
  public function register();
  
  /**
   * autoload function
   *
   * @access public
   * @param object $class
   */
  public static function autoload($class);
}
?>
