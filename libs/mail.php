<?php
/**
 * http://www.phpbuddy.eu/emails-mit-php-versenden.html?start=2
 *
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Mail{
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
	 * @var $_FILES
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
	private $charset = 'UTF-8';

	/**
	 * delimiter for some stuff
	 *
	 * @access private
	 * @var string
	 */
	private static $delimiter;

	/**
	 * constructor
	 */
	public function __construct(){
		$time = (string) time();
		self::$delimiter = md5($time);
	}

	/**
	 * set e-mail receiver
	 *
	 * @access public
	 * @param string $receiver
	 */
	public function setReceiver($receiver){
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
		return $this->receiver;
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
		if(FW_Validate::isString($contentType)){
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
		$this->header = 'From: Test <noreply@' . $_SERVER['SERVER_NAME'] . '>\r\n';
		$this->header .= 'Reply-To: ' . $this->receiverName . '<' . $this->receiver . '>\r\n';
		$this->header .= 'Return-Path: noreply@' . $_SERVER['SERVER_NAME'] . '\r\n';
		$this->header .= 'Date: ' . date('D, d M Y H:i:s O',time()) . '\r\n';
		$this->header .= 'MIME-Version: 1.0\r\n';
		$this->header .= 'Content-Transfer-Encoding: 7bit\r\n';
		$this->header .= 'Message-ID: <' . time() . ' noreply@' . $_SERVER['SERVER_NAME'] . '>\r\n';
		$this->header .= 'X-Mailer: PHP v' . phpversion() . '\r\n';
		$this->header .= 'Content-Type: ' . $this->contentType . '; charset: ' . $this->charset . '\r\n';
		$this->header .= ' boundary= ' . self::$delimiter. '\r\n';
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
			$prepare = '--' . self::$delimiter . '\r\n';
			$prepare .= 'Content-Type: ' . $this->contentType . '; charset=' . $this->charset . '\r\n';
			$prepare .= 'Content-Transfer-Encoding: UTF-8\r\n';

			// attach attachment
			$attach = '--' . self::$delimiter . '\r\n';
			$attach .= 'Content-Type: ' . $this->attachment['type'] . '; name="' . $this->attachment['name'] . '"\r\n';
			$attach .= 'Content-Transfer-Encoding: base64\r\n';
			$attach .= chunk_split(base64_encode(file_get_contents($this->attachment['tmp_name'])));
			$attach .= '\n';
		}

		$this->body = $prepare;
		$this->body .= nl2br(htmlspecialchars($body));
		$this->body .= '\r\n\r\b';
		$this->body .= $attach;
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
	 * @return mixed
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
	 * @return $_FILES
	 */
	public function getAttachment(){
		return $this->attachment;
	}

	/**
	 * send mail
	 */
	public function send(){
		$res = @mail($this->receiver, $this->subject, $this->body, $this->header);

		if(!$res){
			echo "some error with mail send";
		}
	}
}
?>
