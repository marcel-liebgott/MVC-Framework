<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Model{
    protected $registry;
    
    public function __construct(){
        $this->registry = FW_Registry::getInstance();
    }
}