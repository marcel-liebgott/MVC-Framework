<?php
/**
 * filter interface
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.00
 */
interface FW_Interface_Filter{
	/**
	 * execute an filter
	 * 
	 * @access public
	 * @since 1.00
	 * @param FW_Request $request
	 * @param FW_Response $response
	 */
	public function execute($request, $response);
}
?>
