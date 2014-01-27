<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

interface FW_Interface_Filter{
	public function execute(FW_Request $request, FW_Response $response);
}
?>