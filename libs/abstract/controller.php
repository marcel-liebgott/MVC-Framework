<?php
if(!defined('PATH')){
	die('no direct script access allowed');
}

/**
 * basic class for all custom controller types
 * 
 * @author Marcel Liebgott <marcel@mliebgott.de>
 * @version 1.10
 */
abstract class FW_Abstract_Controller{
	/**
	 * controller view
	 *
	 * @access protected
	 * @var FW_View
	 */
	protected $view;
	
	/**
	 * database connection
	 *
	 * @access protected
	 * @var FW_Database
	 */
	protected $db;
	
	/**
	 * special instance with special application stuff
	 *
	 * @access protected
	 * @var FW_Special
	 */
	protected $special;
	
	/**
	 * HTML elements
	 *
	 * @access protected
	 * @var FW_HTML
	 */
	protected $html;
	
	/**
	 * request
	 *
	 * @access protected
	 * @var FW_Request
	 */
	protected $request;
	
	/**
	 * Response
	 *
	 * @access protected
	 * @var FW_Response
	 */
	protected $response;
	
	/**
	 * language
	 *
	 * @access protected
	 * @var FW_Language
	 */
	protected $lang;
	
	/**
	 * filter which run before controller execution
	 * 
	 * @access protected
	 * @var FW_FilterChain
	 */
	protected $preFilter;
	
	/**
	 * filter which run after controller execution
	 * 
	 * @access protected
	 * @var FW_FilterChain
	 */
	protected $postFilter;
	
	/**
	 * model instance
	 * 
	 * @access protected
	 * @var FW_Mvc_Model
	 */
	protected $model;
	
	/**
	 * grant access for guests
	 * by default the access is true
	 * 
	 * @access public
	 * @var boolean
	 */
	public $_guestAccess = true;
	
	/**
	 * collection with user groups which have access to this controller
	 * 
	 * @access public
	 * @var FW_Array
	 */
	private $_groupAccess;
	
	/**
	 * collection with user groups who haven'T any access to this controller
	 * ensure that if an user has both properties (allowed and denied) user groups so the allowed wins
	 * 
	 * @access private
	 * @var FW_Array
	 */
	private $_groupDenied;
	
	/**
	 * constructor
	 * 
	 * @access protected
	 */
	protected function __construct(){
		$registry = FW_Registry::getInstance();
		
		$this->special = FW_Special::getInstance();
		$this->view = new FW_Mvc_View($this);
		$this->db = $registry->getDatabase();
		$this->request = $registry->getRequest();
		$this->response = $registry->getResponse();
		$this->lang = $registry->getLanguage();
		$this->preFilter = new FW_FilterChain();
		$this->postFilter = new FW_FilterChain();
		
		$this->_groupAccess = new FW_Array();
		$this->_groupDenied = new FW_Array();
	}
	
	/**
	 * add an pre filter
	 *
	 * @access public
	 * @param FW_Interface_Filter $filter
	 */
	public function addPreFilter(FW_Interface_Filter $filter){
		$this->preFilter->addFilters($filter);
	}
	
	/**
	 * add an post filter
	 *
	 * @access public
	 * @param FW_Interface_Filter $filter
	 */
	public function addPostFilter(FW_Interface_Filter $filter){
		$this->postFilter->addFilters($filter);
	}
	
	/**
	 *handle http request
	 *
	 * @access public
	 * @param FW_Request $request
	 * @param FW_Response $response
	 */
	public function handleRequest(FW_Request $request, FW_Response $response){
		$this->preFilter->processFilters($request, $response);
		$this->postFilter->processFilters($request, $response);
	
		$response->send();
	}
	
	/**
	 * load controller model
	 *
	 * @access public
	 * @param string $name
	 * @param string $modelPath
	 */
	public function loadModel($name, $modelPath){
		$path = $modelPath . $name . '_model.php';
	
		if(file_exists($path)){
			require_once $path;
			$modulName = $name . '_model';
			$this->model = new $modulName();
		}
	}
	
	/**
	 * add a user group which have access to this controller
	 * 
	 * @access protected
	 * @since 1.10
	 * @param int $groupId
	 */
	protected function addAccessGroup($groupId){
		$this->_groupAccess->add($groupId);
	}
	
	/**
	 * add a group which doesn't have any access to this controller
	 * ensure that if an user does have both properties (access and denied) that access wins
	 * 
	 * @access protected
	 * @since 1.10
	 * @param int $groupId
	 */
	protected function addDeniedGroup($groupId){
		$this->_groupDenied->add($groupId);
	}
	
	/**
	 * chekc if the given user group have access to the current controller
	 * 
	 * @access public
	 * @param int $gid
	 * @return boolean
	 */
	public function hasAccess($gid){
		if($this->_groupAccess !== null){
			if($this->_groupAccess->get($gid)){
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * check if the provided user group doesn't have access to the current user group
	 * 
	 * @access public
	 * @param int $gid
	 * @return boolean
	 */
	public function hasDeniedAccess($gid){
		if($this->_groupDenied->get($gid)){
			return true;
		}
		
		return false;
	}
}
?>