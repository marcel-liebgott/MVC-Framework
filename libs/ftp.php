<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * you can manipulate file, directories and much more at the given ftp server
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Ftp{
	/**
	 * ftp connection
	 *
	 * @access private
	 * @var resource
	 */
	private $con;
	/**
	 * ftp host
	 *
	 * @access private
	 * @var string
	 */
	private $host;

	/**
	 * ftp port
	 *
	 * @access private
	 * @var int
	 */
	private $port;

	/**
	 * ftp user
	 *
	 * @access private
	 * @var string
	 */
	private $user;

	/**
	 * ftp pass
	 *
	 * @access private
	 * @var string
	 */
	private $pass;

	/**
	 * timeout
	 *
	 * @access private
	 * @var int
	 */
	private $timeout;

	/**
	 * enable upload mode
	 *
	 * @access private
	 * @var array
	 */
	private $enableMode = array(FTP_ASCII, FTP_BINARY);

	/**
	 * constructor
	 *
	 * @access public
	 * @param string $host
	 * @param int $port
	 * @param string $user
	 * @param string $pass
	 * @param int $timeout
	 */
	public function __construct($host, $port = 21, $user, $pass, $timeout = 90){
		$this->setHost($host);
		$this->setPort($port);
		$this->setUser($user);
		$this->setPass($pass);
		$this->setTimeout($timeout);
	}

	/**
	 * set ftp host
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
	 * get ftp host
	 *
	 * @access public
	 * @return string
	 */
	public function getHost(){
		return $this->host;
	}

	/**
	 * set ftp port
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
	 * get ftp port
	 *
	 * @access public
	 * @return int
	 */
	public function getPort(){
		return $this->port;
	}

	/**
	 * set ftp user
	 *
	 * @access public
	 * @param string $user
	 */
	public function setUser($user){
		if(FW_Validate::isString($user)){
			$this->user = $user;
		}
	}

	/**
	 * get ftp user
	 *
	 * @access public
	 * @return string
	 */
	public function getUser(){
		return $this->user;
	}

	/**
	 * set ftp pass
	 *
	 * @access public
	 * @param string $pass
	 */
	public function setPass($pass){
		if(FW_Validate::isString($pass)){
			$this->pass = $pass;
		}
	}

	/**
	 * get ftp pass
	 *
	 * @access public
	 * @return string
	 */
	public function getPass(){
		return $this->pass;
	}

	/**
	 * set ftp timeout
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
	 * get ftp timeout
	 *
	 * @access public
	 * @return int
	 */
	public function getTimeout(){
		return $this->timeout;
	}

	/**
	 * connect to a ftp server
	 *
	 * @access public
	 * @throws FW_Exception_ConnectionFailure
	 */
	public function connect(){
		$this->con = ftp_connect($this->host, $this->port, $this->timeout);

		if(!$this->con){
			throw new FW_Exception_ConnectionFailure("Can't connect to FTP-Server: " . $this->host) ;
		}

		$this->login();
	}

	/**
	 * close connection
	 *
	 * @access public
	 */
	public function close(){
		ftp_close($this->con);
	}

	/**
	 * login at ftp server
	 *
	 * @access public
	 * @throws FW_Exception_ConnectionFailure
	 */
	public function login(){
		if(!ftp_login($this->con, $this->user, $this->pass)){
			throw new FW_Exception_ConnectionFailure("Can't login on FTP-Server: " . $this->host . "\n"."Please check your FTP-Settings");
		}
	}

	/**
	 * upload an file to ftp-server
	 *
	 * @access public
	 * @throws FW_Exception_MissingData
	 * @param string $remoteFile
	 * @param string $localFile
	 * @param int $mode
	 * @return boolean
	 */
	public function uploadFile($remoteFile, $localFile, $mode = FTP_ASCII){
		if(!in_array($mode, $this->enableMode)){
			throw new FW_Exception_MissingData("FTP-Mode not supported");
		}

		if(FW_Validate::isString($remoteFile) && FW_Validate::isString($localFile)){
			return ftp_put($this->con, $remoteFile, $localFile, $mode);
		}
	}

	/**
	 * change file permisson
	 *
	 * @access public
	 * @param string $file
	 * @param int $mode
	 * @return int
	 */
	public function chmod($file, $mode){
		if(function_exists('ftp_chmod')){
			return ftp_chmod($this->con, $mode, $file);
		}else{
			return ftp_size($this->con, sprintf('CHMOD %o %d', $mode, $file));
		}
	}

	/**
	 * add a new directory
	 *
	 * @access public
	 * @param string $dirName
	 * @return string
	 */
	public function mkdir($dirName){
		if(FW_Validate::isString($dirName)){
			return ftp_mkdir($this->con, $dirName);
		}
	}

	/**
	 * change directory
	 *
	 * @access public
	 * @param string $dirName
	 * @return boolean
	 */
	public function chdir($dirName){
		if(FW_Validate::isString($dirName)){
			return ftp_chdir($this->con, $dirName);
		}
	}

	/**
	 * get a list with all files in directory
	 * with details ($mode = 1)
	 *
	 * @access public
	 * @param string $dirName
	 * @param int $mode
	 * @return array
	 */
	public function getFileList($dirName, $mode = 0){
		if(FW_Validate::isInteger($mode)){
			if($mode == 0){
				return ftp_nlist($this->con, $dirName);
			}else if($mode == 1){
				return ftp_rawlist($this->con, $dirName);
			}
		}
	}

	/**
	 * rename a file
	 *
	 * @access public
	 * @param string $oldName
	 * @param string $newName
	 * @return boolean
	 */
	public function rename($oldName, $newName){
		return ftp_rename($this->con, $oldName, $newName);
	}

	/**
	 * delete an file
	 *
	 * @access public
	 * @param string $path
	 * @return boolean
	 */
	public function delete($path){
		return ftp_delete($this->con, $path);
	}
}
?>
