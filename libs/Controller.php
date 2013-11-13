<?php
if(!defined('PATH')){
	die("no direct script access allowed");
}

/**
 * Controller
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @category Marcel Liebgott
 */
class FW_Controller{
	/**
	 * resolver
	 *
	 * @access private
	 * @var FW_CommandResolver
	 */
	//private $resolver;

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
	 * logger instance
	 *
	 * @access protected
	 * @var FW_Logger
	 */
	protected $log;

	/**
	 * breadcrumb navigation
	 *
	 * @access private
	 * @var FW_Breadcrumb
	 */
	protected $breadcrumb;

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
	 * constructor
	 *
	 * @access public
	 */
	public function __construct(/*FW_CommandResolver $resolver*/){
		$this->special = FW_Special::getInstance();
		$this->view = new FW_View(get_class($this));
		$this->db = FW_Registry::getInstance()->getDatabase();
		$this->log = FW_Registry::getInstance()->getLogger();
		$this->breadcrumb = FW_Breadcrumb::getInstance();
		$this->html = new FW_HTML();
		// $this->resolver = $resolver;
		$this->preFilter = new FW_FilterChain();
		$this->postFilter = new FW_FilterChain();
	}

	/**
	 * add an pre filter
	 *
	 * @access public
	 * @param FW_Filter
	 */
	public function addPreFilter(FW_Filter $filter){
		$this->preFilter->addFilter($filter);
	}

	/**
	 * add an post filter
	 *
	 * @access public
	 * @param FW_Filter
	 */
	public function addPostFilter(FW_Filter $filter){
		$this->postFilter->addFilter($filter);
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