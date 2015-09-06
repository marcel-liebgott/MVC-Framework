<?php
if(!defined('PATH')){
  die('no direct script access allowed');
}

/**
 * basic class to define controller
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
interface FW_Interface_Controller{
  public function addPreFilter(FW_Interface_Filter $filter);
  
  public fucntion addPosdtFilter(FW_Interface_Filter $filter);
  
  public function handleRequest(FW_Request $request, FW_Response $response);
  
  public funtion loadModel($name, $modelPath);
}
?>
