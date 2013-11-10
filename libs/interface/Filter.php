<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

interface FW_Filter{
	public function execute(FW_Request, FW_Response);
}
?>