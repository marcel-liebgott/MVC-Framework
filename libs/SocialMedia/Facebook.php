<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * lesen: https://developers.facebook.com/docs/graph-api/common-scenarios/#stealthpublish
 */
class FW_SocialMedia_Facebook{
	private $appID = '124924010926407';
	private $accessSecure = '7c843066886dfcdc38289a0f5b143c2b';

	private $facebook;

	public function __construct(){
		$this->facebook = new FW_SocialMedia_Facebook_Facebook(array('appId' => $this->appID, 'secret' => $this->accessSecure));

		$user = $this->facebook->getUser();
		$token = $this->facebook->getAccessToken();

		$attachment = array(
			'access_token'=>$token,
			'message' => 'This is where the message will go.',
			'name' => 'Marcel',
			'link' => 'http://www.mleibgott.de',
			'description' => 'Description text.'
		);

		$this->facebook->api('/me/feed/','post', array('message' => 'Test auf facebook wall'));
	}
}
?>