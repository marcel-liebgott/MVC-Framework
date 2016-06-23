<?php
if(!defined('PATH')){
	throw new FW_Exception_AccessDenied("no direct skript access allowed");
}

/**
 * Bootstrap
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @version 1.00
 */
class FW_Bootstrap extends FW_Singleton{
	/**
	 * registry instance
	 *
	 * @access private
	 * @static
	 * @var instance
	 */
	private static $registry = null;

	/**
	 * actually controller
	 *
	 * @access private
	 * @var resource
	 */
	private $controller = null;

	/**
	 * current URL
	 *
	 * @access private
	 * @var array
	 */
	private $url;

	/**
	 * request
	 *
	 * @aacess private
	 * @var FW_Request
	 */
	private $request;
	
	/**
	 * response
	 * 
	 * @access private
	 * @var FW_Response
	 */
	private $response;

	/**
	 * return singleton instance
	 * 
	 * @access public
	 * @since 1.00
	 * @return FW_Bootstrap
	 */
	public static function getInstance(){
		return parent::_getInstance(get_class());
	}

	/**
	 * constructor
	 * 
	 * @access public
	 * @since 1.00
	 */
	public function __construct(){
		if(self::$registry === null){
			self::$registry = FW_Registry::getInstance();
		}
	}

	/**
	 * initialise the registry
	 *
	 * @access private
	 * @since 1.00
	 */
	private function initRegistry(){
		FW_Session::set('lang', DEFAULT_LANG);

		$lang = FW_Language::getInstance();
		self::$registry->setLanguage($lang);

		$this->request = FW_Request::getInstance();
		self::$registry->setRequest($this->request);

		$this->response = FW_Response::getInstance();
		self::$registry->setResponse($this->response);

		$config = FW_Configuration::getInstance();
		$config->readIni(CONFIG_DIR . CONFIG_FILE);
		self::$registry->setConfiguration($config);

		$db = FW_Database::getInstance();
		self::$registry->setDatabase($db);
		
		$cookies = new FW_Cookie();
		self::$registry->set('cookies', $cookies);

		$bbcode = FW_BBCode::getInstance();
		$bbcode->readBBCodeXML('public/editor/bbcode.xml');
		$bbcode->readSmileyXML('public/editor/smiley.xml');
		self::$registry->set('bbcode', $bbcode);
		
		$this->url = $this->request->getUrl();
		
		// init current user
		$user = FW_Session::get(CURRENT_SESSION_USER);
		
		if(!isset($user) && $user === null){
			$user = new FW_User_Data();
				
			FW_Session::set(CURRENT_SESSION_USER, $user);
		}
	}

	/**
	 * init all stuff
	 *
	 * @access public
	 * @since 1.00
	 * @return boolean
	 */
	public function init(){
		$this->initRegistry();

		if(empty($this->url[0])){
			$this->loadDefaultController();
			return false;
		}

		if($this->loadExistingController() !== false){
			$this->callControllerMethod();
		}
	}

	/**
	 * load default controller if nothing are called
	 *
	 * @access private
	 * @since 1.00
	 * @throws FW_Exception
	 */
	private function loadDefaultController(){
		$path = CONTROLLER_DIR . 'index.php';
		
		if(file_exists($path)){
			require_once CONTROLLER_DIR . 'index.php';
			
			$this->instanziateController('index');
			
			if($this->checkControllerAccess()){
				$this->controller->handleRequest($this->request, $this->response);
				$this->controller->loadModel('index', MODEL_DIR);
				$this->controller->index();
			}else{
				$this->response->redirectUrl(FW_ACCESS_DENIED_PAGE, true);
			}
		}else{
			throw new FW_Exception("The requested file does not exists (" . $path . ")");
		}
	}

	/**
	 * if controller exists, load them
	 *
	 * @access private
	 * @since 1.00
	 * @param string $controller
	 */
	private function loadExistingController($controller = null){
		if(isset($controller)){
			$com = $controller;
		}else{
			$com = $this->url[0];
		}

		$controller_dir = CONTROLLER_DIR;
		$model_dir = MODEL_DIR;

		$file = $controller_dir . $com . '.php';

		if($this->existsController($file)){
			require_once $file;
			$this->instanziateController($com);
			
			if($this->checkControllerAccess()){
				$this->controller->loadModel($com, $model_dir);
			}else{
				// no access
				$this->response->redirectUrl(FW_ACCESS_DENIED_PAGE, true);
			}
		}else{
			// 404
			$this->response->redirectUrl(FW_NOT_FOUND_PAGE, true);
		}
	}

	/**
	 * call a method
	 *
	 * @access private
	 * @since 1.00
	 * @throws FW_Exception_UnsupportedMethod
	 */
	private function callControllerMethod(){
		if(FW_String::strtolower($this->url[0]) === 'acp'){
			array_shift($this->url);
		}

		if(isset($this->url[1])){
            if(method_exists($this->controller, $this->url[1])){
                $length = count($this->url);

                if($length > 1){
                    switch($length){
                        case 5:     $this->controller->{$this->url[1]}($this->url[2], $this->url[3], $this->url[4]);
                            break;
                        case 4:     $this->controller->{$this->url[1]}($this->url[2], $this->url[3]);
                            break;
                        case 3:     $this->controller->{$this->url[1]}($this->url[2]);
                            break;
                        case 2:     $this->controller->{$this->url[1]}();
                            break;
                        default:    $this->controller->index();
                            break;
                    }
                }
            }else{
            	throw new FW_Exception_UnsupportedMethod($this->url[1] . " dosn't exists");
            }
        }else{
            $this->controller->index();
        }
	}
	
	/**
	 * check if the current user has access to the requestes controller
	 * 
	 * @access private
	 * @since 1.10
	 * @return boolean
	 */
	private function checkControllerAccess(){
		// check if called constructor have access for the current user
		$user = FW_Session::get(CURRENT_SESSION_USER);
		$groupId = $user->getUserData(FW_DB_TBL_USER_GROUP);
			
		if(!$this->controller->hasAccess($groupId)){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * instanziate the called controller
	 * 
	 * @access private
	 * @since 1.02
	 * @param String $name
	 */
	private function instanziateController($name){
		$controller = 'FW_Front_' . $name;
		$this->controller = new $controller();
	}
	
	/**
	 * checked if controller existst;
	 *
	 * @access private
	 * @param string $file
	 * @return boolean
	 */
	private function existsController($file){
		return file_exists($file) ? true : false;
	}
}
?>
