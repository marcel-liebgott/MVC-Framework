<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * comparison to check if a new Version exists
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
final class FW_VersionCompare{
	/**
	 * check for new update
	 *
	 * @access public
	 * @since 1.00
	 * @static
	 * @return boolean
	 */
	public static function checkForUpdate(){
		$socket = new FW_Socket(FW_HOST);
		$data = $socket->post(FW_PATH, null);
		
		if($data !== null){
			if(FW_String::strpos($data, '|') > 0){
				$data_arr = explode("|", $data);
				
				if($data_arr !== null && count($data_arr) == 2){
					$version = $data_arr[0];
					$state = $data_arr[1];
			
					if(FW_Version::getVersionId() < $version){
						return true;
					}else{
						if(FW_Version::getVersionId() == $version){
							$version_id = constant('STATE_' . FW_String::strtoupper($state));
			
							if(FW_String::strtoupper(FW_Version::getVersionState()) < $version_id){
								return true;
							}
						}
					}
				}
			}
		}
		
		return false;
	}
}
?>
