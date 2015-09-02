<?php
if(!defined('PATH')){
  die('no direct script access allowed');
}

/**
 * interface for autoload implementation
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.02
 */
interface FW_Interface{
  /**
   * register an autoloader
   *
   * @access public
   * @since 1.02
   */
  public function register();
  
  /**
   * autoload function
   *
   * @access public
   * @since 1.02
   */
  public function autoload($class);
}
?>
