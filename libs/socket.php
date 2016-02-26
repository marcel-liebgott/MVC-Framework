<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * get data from another server
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @since 1.00
 */
class FW_Socket{
	/**
	 * socket connection
	 *
	 * @access private
	 * @var resource
	 */
	private $con;

	/**
	 * socket host
	 *
	 * @access private
	 * @var string
	 */
	private $host;

	/**
	 * socket port
	 *
	 * @access private
	 * @var int
	 */
	private $port;

	/**
	 * error number
	 *
	 * @access private
	 * @var int
	 */
	private $errno;

	/**
	 * error message
	 *
	 * @access private
	 * @var string
	 */
	private $error;

	/**
	 * connection timeout
	 *
	 * @access private
	 * @var int
	 */
	private $timeout;

	/**
	 * default line ending
	 *
	 * @access private
	 * @var string
	 */
	private static $lineEnd = "\r\n";

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $host
	 * @param int $port
	 */
	public function __construct($host, $port = 80, $timeout = 30){
		$this->setHost($host);
		$this->setPort($port);
		$this->setTimeout($timeout);
	}

	/**
	 * set socket host
	 *
	 * @access public
	 * @param string $host
	 */
	public function setHost($host){
		if(FW_Validate::isValidUrl($host)){
			$this->host = $host;
		}
	}

	/**
	 * get socket host
	 *
	 * @access public
	 * @return string
	 */
	public function getHost(){
		return $this->host;
	}

	/**
	 * set socket port
	 *
	 * @access public
	 * @param int $port
	 */
	public function setPort($port){
		if(FW_Validate::isInteger($port)){
			$this->port = $port;
		}
	}

	/**
	 * get socket port
	 *
	 * @access public
	 * @return int
	 */
	public function getPort(){
		return $this->port;
	}

	/**
	 * set socket timeout
	 *
	 * @access public
	 * @param int $timeout
	 */
	public function setTimeout($timeout){
		if(FW_Validate::isInteger($timeout)){
			$this->timeout = $timeout;
		}
	}

	/**
	 * get socket timeout
	 *
	 * @access public
	 * @return int
	 */
	public function getTimeout(){
		return $this->timeout;
	}

	/**
	 * get error code
	 *
	 * @access public
	 * @return int
	 */
	public function getErrorCode(){
		return $this->errno;
	}

	/**
	 * get error message
	 *
	 * @access public
	 * @return string
	 */
	public function getErrorMessage(){
		return $this->error;
	}

	/**
	 * send a post request
	 *
	 * @access public
	 * @param string $path
	 * @param string $data
	 * @return string
	 */
	public function post($path, $data){
		$request = 'POST ' . $path . ' HTTP/1.1' . self::$lineEnd;
		$request .= $this->getSocketLine('Host', $this->host);
		$request .= $this->getSocketLine('Content-Type', 'application/x-www-form-urlencoded');
		$request .= $this->getSocketLine('Content-Length', (string) FW_String::strlen($data));
		$request .= $this->getSocketLine('Connection', 'close' . "\r\n");
		$request .= $data;

		return $this->sendRequest($request);
	}

	/**
	 * send get request
	 *
	 * @access public
	 * @param string $path
	 * @return string
	 */
	public function get($path){
		$request = 'GET ' . $path . ' HTTP/1.1' . self::$lineEnd;
		$request .= $this->getSocketLine('Host', $this->host);
		$request .= $this->getSocketLine('Connection', 'close' . self::$lineEnd);

		return $this->sendRequest($request);
	}

	/**
	 * get an validated line to send it over this connection
	 *
	 * @access private
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	private function getSocketLine($key, $value){
		return $key . ': ' . $value . self::$lineEnd;
	}

	/**
	 * send data
	 *
	 * @access private
	 * @throws FW_Exception_ConnectionFailure
	 * @param string $data
	 * @return string
	 */
	private function sendRequest($data){
		$this->con = fsockopen($this->host, $this->port, $this->errno, $this->error, $this->timeout);

		if(!$this->con){
			throw new FW_Exception_ConnectionFailure("can't connect to host: " . $this->host);
		}

		fputs($this->con, $data);

		$ret = '';
		while(!feof($this->con)){
			$ret .= fgets($this->con, 128);
		}

		$this->closeConnection();

		return $this->getContent($ret);
	}

	/**
	 * close connection
	 *
	 * @access private
	 */
	private function closeConnection(){
		fclose($this->con);
	}

	/**
	 * get content
	 *
	 * @access private
	 * @param string $data
	 * @return string
	 */
	private function getContent($data){
		$pos = FW_String::strpos($data, "\r\n\r\n");

		return FW_String::substr($data, $pos);
	}
}
?>
