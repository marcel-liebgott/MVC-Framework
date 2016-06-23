<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * interface to define feed types
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @since 1.01
 */
interface FW_Interface_FeedType{
	/**
	 * define output
	 * 
	 * @access public
	 * @since 1.01
	 * @param FW_Feed_Document $document
	 * @return String
	 */
	public function render($document);
}
?>
