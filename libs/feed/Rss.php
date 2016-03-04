<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * RSS news feed
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.01
 */
class FW_Feed_RSS implements FW_Interface_FeedType{
	/**
	 * (non-PHPdoc)
	 * @see FW_Interface_FeedType::render()
	 */
	public function render($document){
		$xml = '<?xml version="1.0" encoding="' . $document->getEncoding() . '" ?>';
		$xml .= '<rss version="' . $document->getVersion() . '">';
		
		// channel
		$xml .= '<channel>';
		
		$xml .= '<title>' . $document->getTitle() . '</title>';
		$xml .= '<link>' . $document->getLink() . '</link>';
		$xml .= '<description>' . $document->getDescription() . '</description>';
		$xml .= '<category>' . $document->getCategory() . '</category>';
		$xml .= '<language>' . $document->getLanguage() . '</language>';
		$xml .= '<date>' . $document->getDate() . '</date>';
		
		// items
		$items = $document->getItems();
		
		foreach($items as $item){
			$xml .= '<item>';
				$xml .= '<guid>' . $item->getGuid() . '</guid>';
				$xml .= '<title>' . $item->getTitle() .'</title>';
				$xml .= '<description>' . $item->getDescription() . '</description>';
				$xml .= '<category>' . $item->getCategory() . '</category>';
				$xml .= '<link>' . $item->getLink() . '</link>';
				$xml .= '<author>' . $item->getAuthor() . '</author>';
				$xml .= '<date>' . $item->getDate() . '</date>';
				$xml .= '<comment>' . $item->getComment() . '</comment>';
			$xml .= '</item>';
		}
		
		$xml .= '</channel>';
		
		$xml .= '</rss>';
		
		return $xml;
	}
}
?>