<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_Mail_SMTP extends FW_Mail_Base implements FW_Interface_Mail{
	/**
	 * smtp host
	 *
	 * @access private
	 * @var string
	 */
	private $host;

	/**
	 * smtp port
	 *
	 * @access private
	 * @var int
	 */
	private $port;

	/**
	 * smtp user
	 *
	 * @access private
	 * @var string
	 */
	private $user;

	/**
	 * smtp pass
	 *
	 * @access private
	 * @var mixed
	 */
	private $pass;

	/**
	 * socket connection
	 *
	 * @access private
	 * @var resource
	 */
	private $socket;

	/**
	 * return code
	 *
	 * @access private
	 * @var int
	 */
	private $code;

	public function __construct(){

	}

	/**
	 * set smtp host
	 *
	 * @access private
	 * @var string
	 */
	public function setHost($host){
		if(FW_Validate::isString($host)){
			$this->host = $host;
		}
	}

	/**
	 * get smtp host
	 *
	 * @access public
	 * @return string
	 */
	public function getHost(){
		return $this->host;
	}

	/**
	 * set smtp port
	 *
	 * @access public
	 * @param int
	 */
	public function setPort($port){
		if(FW_Validate::isInteger($port)){
			$this->port = $port;
		}
	}

	/**
	 * get smtp port
	 *
	 * @access public
	 * @return int
	 */
	public function getPort(){
		return $this->port;
	}

	/**
	 * set smtp user
	 *
	 * @access public
	 * @param string
	 */
	public function setUser($user){
		if(FW_Validate::isString($user)){
			$this->user = $user;
		}
	}

	/**
	 * get smtp user
	 *
	 * @access public
	 * @return string
	 */
	public function getUser(){
		return $this->user;
	}

	/**
	 * set smtp pass
	 *
	 * @access public
	 * @param string
	 */
	public function setPass($pass){
		if(FW_Validate::isMixed($pass)){
			$this->pass = $pass;
		}
	}

	/**
	 * get smtp pass
	 *
	 * @access public
	 * @return string
	 */
	public function getPass(){
		return $this->pass;
	}

	/**
	 * @see FW_Interface_Mail::send()
	 */
	public final function send(){
		$this->socket = fsockopen($this->host, $this->port);

		if(!$this->socket){
			echo "can't connect to " . $this->host . ":" . $this->port;
		}

		$this->sendCommand('EHLO')
	}

	/**
	 * send an command to smtp server
	 *
	 * @access private
	 */
	private function sendCommand($comm){
		fputs($this->socket, $comm);

		$this->code = fgets($this->socket, 1024);
	}
}
?>