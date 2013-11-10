<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Exception extends Exception{
    public function __construct($message, $code = 0){
        parent::__construct($message, $code);
    }
}

?>
