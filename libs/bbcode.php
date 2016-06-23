<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied('no direct script access allowed');
}

/**
 * class to convert bbcode tags into string to html entities
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
class FW_BBCode extends FW_Singleton{

	/**
	 * enable BBCode Tags
	 *
	 * @access private
	 * @var array
	 */
	private $enableTags;

	/**
	 * enable Smileys
	 *
	 * @access private
	 * @var array
	 */
	private $enableSmileys;	

	/**
	 * string
	 *
	 * @access private
	 * @var string
	 */
	private $string;

	/**
	 * regex for BBCode-Tag
	 *
	 * @access private
	 * @var string
	 */
	private $tagRegex = '#\[(.*?)\](.*?)\[/(.*?)\]#s';

	/**
	 * number of different characters between BBCode-Tag and replaced text
	 *
	 * @access private
	 * @var int
	 */
	private $charDiff = 0;

	public function __construct(){
	}

	/**
	 * return current instance of this class - singleton
	 *
	 * @access public
	 * @return static instance
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}

	/**
	 * read BBCode XML file
	 *
	 * @access public
	 * @param string $xmlFile
	 */
	public function readBBCodeXML($xmlFile){
		if(file_exists($xmlFile)){
			$xmlContent = simplexml_load_file($xmlFile);

			$xmlCount = count($xmlContent);
			
			for($i = 0; $i < $xmlCount; $i++){
				$id = $xmlContent->Tag[$i]->Id;
				$img = $xmlContent->Tag[$i]->Img;
				$desc = $xmlContent->Tag[$i]->Description;
				$shortcut = $xmlContent->Tag[$i]->Shortcut;
				$replace = $xmlContent->Tag[$i]->Replace;
				$regex = $xmlContent->Tag[$i]->Regex;

				$this->enableTags[(string)$shortcut] = array(
					'id' => (string)$id,
					'img' => (string)$img,
					'desc' => (string)$desc,
					'shortcut' => (string)$shortcut,
					'replace' => (string)$replace,
					'regex' => (string)$regex
				);
			}
		}
	}

	/**
	 * read Smiley XML file
	 *
	 * @access public
	 * @param string $xmlFile
	 */
	public function readSmileyXML($xmlFile){
		if(file_exists($xmlFile)){
			$xmlContent = simplexml_load_file($xmlFile);

			$xmlCount = count($xmlContent);
			
			for($i = 0; $i < $xmlCount; $i++){
				$id = $xmlContent->Item[$i]->Id;
				$img = $xmlContent->Item[$i]->Img;
				$desc = $xmlContent->Item[$i]->Description;
				$shortcut = $xmlContent->Item[$i]->Shortcut;
				$replace = $xmlContent->Item[$i]->Replace;
				$regex = $xmlContent->Item[$i]->Regex;

				$this->enableSmileys[(string)$shortcut] = array(
					'id' => (string) $id,
					'img' => (string)$img,
					'desc' => (string)$desc,
					'shortcut' => (string)$shortcut,
					'replace' => (string)$replace,
					'regex' => (string)$regex
				);
			}
		}
	}

	/**
	 * add an new BBCode Tag
	 *
	 * @access public
	 * @param string $id
	 * @param array $array
	 */
	public function addBBCodeTag($id, $array){
		$this->enableTags[$id] = $array;
	}

	/**
	 * set string, which would be to convert
	 *
	 * @access public
	 * @param string $bbcodeString
	 */
	public function setBBCodeString($bbcodeString){
		$this->string = $bbcodeString;
	}

	/**
	 * check BBCode String
	 * 
	 * @access private
	 * @param array $tags
	 * @return boolean
	 */
	private function checkBBCode($tags){
        $count_open_tags = 0;
        $open_tags = array();

        $countTags = count($tags[3]);
        
        for($i = 0; $i < $countTags; $i++){
        	$tag = $tags[3][$i][0];

        	if(empty($tag[0])){
        		continue;
        	}

        	// if opening tag?
        	if($tag[0] !== '/'){
        		$count_open_tags++;

        		$tag_name = strtolower($tag);

        		array_push($open_tags, $tag_name);
        	}else{
        		// closing tag?
        		if($tag[0] == '/'){
        			$last_tag = array_pop($open_tags);

        			$tag_name = strtolower(substr($tag, 1));

        			if($last_tag == $tag_name){
        				continue;
        			}else{
        				return false;
        			}
        		}
        	}
        }

        return true;
	}

	/**
	 * convert smiley
	 *
	 * @access public
	 */
	public function convertSmiley(){
		foreach($this->enableSmileys as $smiley){
			$this->string = preg_replace($smiley['regex'], $smiley['replace'], $this->string);
		}
	}

	/**
	 * convert BBCode entries
	 *
	 * @access public
	 * @throws FW_Exception_MissingData
	 * @throws FW_Exception
	 */
	public function convertBBCode(){
		// find link
		$this->string = preg_replace('/\[url=(.*?)\](.*?)\[\/url\]/s', '<a href="http://$1">$2</a>', $this->string);
		$this->string = preg_replace('/\[url\](.*?)\[\/url\]/s', '<a href="http://$1">$1</a>', $this->string);

		$tags = array();
		preg_match_all(
        	'/(.*?)(\[(\/?[a-z]+)(=?[^\]\[]*\]))|(.*?)$/si', $this->string, $tags, PREG_OFFSET_CAPTURE
        );

		$check = $this->checkBBCode($tags);

		if(empty($this->string)){
			if($check !== true){
				throw new FW_Exception("something wrong with bbcode");
			}
			
			throw new FW_Exception_MissingData("bbcode string is empty");
		}

		// working with index 2
		$tags = $tags[2];

		$count = count($tags);

		for($i = 0; $i < $count; $i++){
			// get first BBCode Tag
			$tag = $tags[$i][0];

			// tag !== opening
			if(!empty($tag)){
				// is tag an opening tag
				if($tag[1] !== '/'){
					// get position of first BBCode tag in search string
					$pos = $tags[$i][1];

					$match = array();
					// get first tag
					preg_match('/\[(.+?)(?:=(.+?))?\]/si', $tag, $match);

					if(count($match) > 0){
						$tag_name = $match[1];

						// get idx of this first ending tag
						$end_tag_name = '[/' . $tag_name . ']';
						$lenght_ending_tag = strlen($end_tag_name);
						$idx_ending_tag = $this->getIndexOfEndingTag($end_tag_name, $tags);

						$start_pos = $pos + $this->charDiff;

						// BBCode tag without parameter
						if(count($match) == 2){
							if($idx_ending_tag !== -1){
								$substr = substr($this->string, $start_pos, ($idx_ending_tag + $lenght_ending_tag + $this->charDiff) - ($pos));

								$enableTag = $this->enableTags[$tag_name];

								$replacedString = preg_replace($enableTag["regex"], $enableTag['replace'], $substr);
								$this->charDiff += FW_String::strlen($replacedString) - FW_String::strlen($substr);

								$this->string = str_replace($substr, $replacedString, $this->string);
							}
						}

						//BBCode with parameter
						if(count($match) == 3){
							// get value between open and ending tag
							$substr = substr($this->string, $pos, ($idx_ending_tag + $lenght_ending_tag) - $pos);

							$replacedString = preg_replace($enableTag['regex'], $enableTag['replace'], $substr);

							$this->string = str_replace($substr, $replacedString, $this->string);
						}
					}
				}

				// unset first BBCode Tag
				unset($tags[$i]);
			}
		}
	}

	/**
	 * give array of searching ending BBCode tag
	 *
	 * @access private
	 * @param string $end_tag_name
	 * @param array $array
	 * @return int
	 */
	private function getIndexOfEndingTag($end_tag_name, $array){
		foreach($array as $subarray){
			if($subarray[0] === $end_tag_name){
				return $subarray[1];
			}
		}
	}

	/**
	 * get the string
	 *
	 * @access public
	 * @return string
	 */
	public function getString(){
		return $this->string;
	}
}
?>

