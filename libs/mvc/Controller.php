<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * Controller
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Mvc_Controller{
	/**
	 * filter to precess befor script running
	 *
	 * @access private
	 * @var FW_FilterChain
	 */
	private $preFilter;

	/**
	 * filter to process after script running
	 *
	 * @access private
	 * @var FW_FilterChain
	 */
	private $postFilter;

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
	 * langauage
	 *
	 * @access protected
	 * @var FW_Language
	 */
	protected $lang;

	/**
	 * constructor
	 *
	 * @access public
	 */
	public function __construct(){
		$this->special = FW_Special::getInstance();
		$this->view = new FW_Mvc_View(get_class($this));
		$this->db = FW_Registry::getInstance()->getDatabase();
		$this->request = FW_Registry::getInstance()->getRequest();
		$this->response = FW_Registry::getInstance()->getResponse();
		$this->lang = FW_Registry::getInstance()->getLanguage();
		$this->preFilter = new FW_FilterChain();
		$this->postFilter = new FW_FilterChain();

		// site enable
		$url = $this->request->getUrl();

		// do special application stuff
		$this->view->addVariables(array(
		));
	}

	/**
	 * add an pre filter
	 *
	 * @access public
	 * @param FW_Filter
	 */
	public function addPreFilter(FW_Interface_Filter $filter){
		$this->preFilter->addFilters($filter);
	}

	/**
	 * add an post filter
	 *
	 * @access public
	 * @param FW_Filter
	 */
	public function addPostFilter(FW_Interface_Filter $filter){
		$this->postFilter->addFilters($filter);
	}

	/**
	 *handle http request
	 *
	 * @access public
	 * @param FW_Request
	 * @param FW_Response
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
	 * @param string
	 * @param string
	 */
	public function loadModel($name, $modelPath){
		$path = $modelPath . $name . '_model.php';

		if(file_exists($path)){
			require_once $path;
			$modulName = $name . '_model';
			$this->model = new $modulName();
		}
	}
}
?>