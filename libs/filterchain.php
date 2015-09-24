<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * FilterChain
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 * @category Marcel Liebgott
 */
class FW_FilterChain{
	/**
	 * all filters
	 *
	 * @access private
	 * @var array
	 */
	private $filters = array();

	/**
	 * add an filter
	 *
	 * @access public
	 * @param FW_Filter
	 */
	public function addFilters(FW_Interface_Filter $filter){
		$this->filters[] = $filter;
	}

	/**
	 * process a filter
	 *
	 * @access public
	 * @param FW_Request
	 * @param FW_Response
	 */
	public function processFilters(FW_Request $request, FW_Response $response){
		foreach($this->filters as $filter){
			$filter->execute($request, $response);
		}
	}
}
?>
