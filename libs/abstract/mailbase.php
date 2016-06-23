<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * basic class for mail
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
abstract class FW_Abstract_MailBase{
	/**
	 * e-mail from
	 *
	 * @access private
	 * @var string
	 */
	private $from;
	/**
	 * mail header
	 *
	 * @access private
	 * @var string
	 */
	private $header;

	/**
	 * e-mail receiver
	 *
	 * @access private
	 * @var string
	 */
	private $receiver;

	/**
	 * name of the receiver
	 *
	 * @access private
	 * @var string
	 */
	private $receiverName;

	/**
	 * mail body
	 *
	 * @access private
	 * @var string
	 */
	private $body;

	/**
	 * mail subject
	 *
	 * @access private
	 * @var string
	 */
	private $subject = 'New Mail';

	/**
	 * e-mail enable attachment types
	 * 
	 * @access private
	 * @var array
	 */
	private $enableAttachmentTypes = array('image/jpeg');

	/**
	 * e-mail attachment
	 *
	 * @access private
	 * @var array
	 */
	private $attachment;

	/**
	 * e-mail content type
	 *
	 * @access private
	 * @var string
	 */
	private $contentType = 'text/html';

	/**
	 * e-mail charset
	 *
	 * @access private
	 * @var string
	 */
	private $charset = 'ISO-8859-1';

	/**
	 * xmailer
	 *
	 * @access private
	 * @var string
	 */
	private $xmailer = 'MVC-Framework';

	/**
	 * delimiter for some stuff
	 *
	 * @access private
	 * @var string
	 */
	private static $delimiter;

	/**
	 * default line ending
	 *
	 * @access private
	 * @var string
	 */
	private static $lineEnd = "\n";

	/**
	 * email priority
	 * options:
	 *	1 = high
	 *	2 = normal
	 * 	3 = high
	 *
	 * @access private
	 * @var int
	 */
	private $priority = 3;

	/**
	 * constructor
	 */
	public function __construct(){
		$time = time();
		self::$delimiter = md5((string) $time);
	}

	/**
	 * set e-mail from
	 *
	 * @access public
	 * @param string $from
	 */
	public function setFrom($from){
		$from = trim($from);
		
		if(FW_Validate::isValidMail($from)){
			$this->from = $from;
		}
	}

	/**
	 * get e-mail from
	 *
	 * @access public
	 * @return string
	 */
	public function getFrom(){
		return $this->from;
	}

	/**
	 * set e-mail receiver
	 *
	 * @access public
	 * @param string $receiver
	 */
	public function setReceiver($receiver){
		$receiver = trim($receiver);
		
		if(FW_Validate::isValidMail($receiver)){
			$this->receiver = $receiver;
		}
	}

	/**
	 * get receiver
	 *
	 * @access public
	 * @return string
	 */
	public function getReceiver(){
		return $this->receiverName . '<' . $this->receiver . '>';
	}

	/**
	 * set e-mail charset
	 *
	 * @access public
	 * @param string $charset
	 */
	public function setCharset($charset){
		if(FW_Validate::isString($charset)){
			$this->charset = $charset;
		}
	}

	/**
	 * get e-mail charset
	 *
	 * @access public
	 * @return string
	 */
	public function getCharset(){
		return $this->charset;
	}

	/**
	 * set e-mail content type
	 *
	 * @access public
	 * @param string $contentType
	 */
	public function setContentType($contentType){
		if(FW_Validate::isMixed($contentType)){
			$this->contentType = $contentType;
		}
	}

	/**
	 * get e-mail content type
	 *
	 * @access public
	 * @return string
	 */
	public function getContentType(){
		return $this->contentType;
	}

	/**
	 * set e-mail subject
	 *
	 * @access public
	 * @param string $subject
	 */
	public function setSubject($subject){
		if(FW_Validate::isString($subject)){
			$this->subject = $subject;
		}
	}

	/**
	 * get e-mail subject
	 *
	 * @access public
	 * @return string
	 */
	public function getSubject(){
		return $this->subject;
	}

	/**
	 * set e-mail header
	 *
	 * @access private
	 */
	private function setMailHeader(){
		$this->header = $this->getHeaderLine('From', $this->from);
        $this->header .= $this->getHeaderLine('Return-Path', $this->from);
        $this->header .= $this->getHeaderLine('MIME-Version', '1.0');
        $this->header .= $this->getHeaderLine('Date', $this->getDate());
        $this->header .= $this->getHeaderLine('Content-Type', $this->contentType . '; charset=' . $this->charset);
        $this->header .= $this->getHeaderLine('Content-Transfer-Encoding', '8bit');
        $this->header .= $this->getHeaderLine('Message-ID', time() . ' noreply@' . $_SERVER['SERVER_NAME'] . '>');
        $this->header .= $this->getHeaderLine('X-Priority', (string) $this->priority);
        $this->header .= $this->getHeaderLine('X-Mailer', $this->xmailer);
        $this->header .= self::$lineEnd;
	}

	/**
	 * get mail header
	 *
	 * @access protected
	 * @return string
	 */
	protected function getHeader(){
		$this->setMailHeader();

		return $this->header;
	}

	/**
	 * get e-mail header
	 *
	 * @access private
	 * @return string
	 */
	private function getMailHeader(){
		return $this->header;
	}

	/**
	 * set the receiver name of this e-mail
	 *
	 * @access public
	 * @param string $name
	 */
	public function setReceiverName($name){
		if(FW_Validate::isMixed($name)){
			$this->receiverName = $name;
		}
	}

	/**
	 * get receiver name
	 *
	 * @access public
	 * @return string
	 */
	public function getReceiverName(){
		return $this->receiverName;
	}

	/**
	 * set XMailer of this email
	 *
	 * @access public
	 * @param string $xmailer
	 */
	public function setXmailer($xmailer){
		if(FW_Validate::isString($xmailer)){
			$this->xmailer = $xmailer;
		}
	}

	/**
	 * get xmailer
	 *
	 * @access public
	 * @return string
	 */
	public function getXmailer(){
		return $this->xmailer;
	}

	/**
	 * set email priority
	 *
	 * @access public
	 * @param int $priority
	 */
	public function setPriority($priority){
		if(FW_Validate::isInteger($priority) && ($priority == 1 || $priority == 3 || $priority == 5)){
			$this->priority = $priority;
		}
	}

	/**
	 * get priority
	 *
	 * @access public
	 * @return int
	 */
	public function getPriority(){
		return $this->priority;
	}

	/**
	 * set e-mail body
	 *
	 * @access public
	 * @param string $body
	 */
	public function setMailBody($body){
		$prepare = '';
		$attach = '';

		if(count($this->attachment) > 0){
			// prepare e-mail body
			$prepare = '--' . self::$delimiter . "\n";
			$prepare .= $this->getHeaderLine('Content-Type', $this->contentType . '; charset=' . $this->charset);
			$prepare .= $this->getHeaderLine('Content-Transfer-Encoding', 'UTF-8');

			// attach attachment
			$attach = '--' . self::$delimiter . "\n";
			$attach .= $this->getHeaderLine('Content-Type', $this->attachment['type'] . '; name="' . $this->attachment['name'] . '"');
			$attach .= $this->getHeaderLine('Content-Transfer-Encoding', 'base64');;
			$attach .= chunk_split(base64_encode(file_get_contents($this->attachment['tmp_name'])));
			$attach .= self::$lineEnd;
		}

		$this->body = $prepare;
		$this->body .= nl2br($body);
		$this->body .= self::$lineEnd . self::$lineEnd;
		$this->body .= $attach;
	}

	/**
	 * get body
	 *
	 * @access protected
	 * @return string
	 */
	protected function getBody(){
		return $this->body;
	}

	/**
	 * get the mail body
	 *
	 * @access public
	 * @return string
	 */
	public function getMailBody(){
		return $this->body;
	}

	/**
	 * check file attachment
	 *
	 * @access private
	 * @param string $name
	 * @return string|boolean
	 */
	private function checkAttachment($name){
		if(FW_Validate::isString($name)){
			$request = FW_Registry::getInstance()->getRequest();

			$file = $request->getFile($name);

			if($file['error'] == 0 && in_array($file['type'], $this->enableAttachmentTypes)){
				return $file['name'];
			}else{
				return false;
			}
		}
	}

	/**
	 * set e-mail attachment
	 *
	 * @access public
	 * @param string $name
	 */
	public function setAttachment($name){
		$file = $this->checkAttachment($name);

		if($file !== false){
			$this->attachment = $file;

			$this->contentType = 'multipart/mixed';
		}
	}

	/**
	 * get attachment
	 *
	 * @access public
	 * @return array
	 */
	public function getAttachment(){
		return $this->attachment;
	}

	/**
	 * generate a email header line
	 *
	 * @access private
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	private function getHeaderLine($key, $value){
		return $key . ': ' . $value . self::$lineEnd;
	}

	/**
	 * get formatted date
	 *
	 * @access private
	 * @return string
	 */
	private function getDate(){
		return date('D, j M Y H:i:s O');
	}
}
?>
