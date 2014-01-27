<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Mvc_Model{
    protected $registry;
    protected $db;
    
    public function __construct(){
        $this->registry = FW_Registry::getInstance();
        $this->db = $this->registry->getDatabase();
    }
}