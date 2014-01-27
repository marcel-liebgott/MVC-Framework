<?php
if(!defined('PATH')){
  die('no direct script access allowed');
}

class FW_SocialMedia_Twitteroauth_OAuthConsumer{
  public $key;
  public $secret;

  function __construct($key, $secret, $callback_url=NULL) {
    $this->key = $key;
    $this->secret = $secret;
    $this->callback_url = $callback_url;
  }

  function __toString() {
    return "OAuthConsumer[key=$this->key,secret=$this->secret]";
  }
}
?>