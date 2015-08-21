<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

final class FW_VersionCompare{
	/**
	 * check for new update
	 *
	 * @access public
	 * @static
	 * @return boolean
	 */
	public static function checkForUpdate(){
		$socket = new FW_Socket(FW_HOST);
		$data = $socket->post(FW_PATH, null);

		$data_arr = explode("|", $data);

		$version = $data_arr[0];
		$state = $data_arr[1];

		if(FW_VERSION_ID < $version){
			return true;
		}else{
			if(FW_VERSION_ID == $version){
				$version_id = constant('STATE_' . FW_String::strtoupper($state));

				if(FW_VERSION_STATE < $version_id){
					return true;
				}
			}
		}
	}
}
?>