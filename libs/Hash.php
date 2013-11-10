<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Hash{
    public function __construct(){
    }

    /**
     * 
     * @param string $algo algorithm (md5, sha1, wirlpool, ...)
     * @param string $data data to encode
     * @param string $salt salt
     * @return string hash
     */
    public static function create($algo, $data, $salt){
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        
        return hash_final($context);
    }
}

?>