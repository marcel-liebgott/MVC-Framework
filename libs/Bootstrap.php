<?php
if(!defined('PATH')){
	die("no direct skript access allowed");
}

/**
 * Bootstrap
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @category Marcel Liebgott
 */
class FW_Bootstrap{
	/**
	 * object instance
	 *
	 * @access private
	 * @var instance
	 */
	private static $registry = null;
	private $controller = null;

	private $request;
	private $response;
	private $db;
	private $lang;
	private $msg;

	private $url;

	public function __construct(){
	}

	public function setRegistry(){
		if(self::$registry === null){
			self::$registry = new FW_Registry();
		}

		$this->initRegistry();
	}

	private function getUrl(){
		$this->url = $this->request->getUrl();
	}

	private function initRegistry(){
		$this->request = FW_Request::getInstance();
		$this->response = FW_Response::getInstance();
		$this->db = FW_Database::getInstance();
		$this->lang = FW_Language::getInstance();
		$this->msg = FW_Messages::getInstance();

		self::$registry->setRequest($this->request);
		self::$registry->setResponse($this->response);
		self::$registry->setDatabase($this->db);
		self::$registry->setLanguage($this->lang);
		self::$registry->setMessages($this->msg);
	}

	public function init(){
		$this->setRegistry();

		$this->getUrl();

		if(empty($this->url[0])){
			$this->loadDefaultController();
			return false;
		}

		if($this->loadExistingController() !== false){
			$this->callControllerMethod();
		}
	}

	private function loadDefaultController(){
		require_once CONTROLLER_DIR . 'index.php';
		$this->controller = new index();
		$this->controller->loadModel('index', MODEL_DIR);
		$this->controller->index();
	}

	private function existsController($file){
		echo "existsController(" . $file . ")<br>";
		return file_exists($file)  ? true : false;
	}

	private function loadExistingController($controller = null){
		if(strtolower($this->url[0]) === 'acp' && isset($this->url[1])){
			$com = $this->url[1];
			$controller_dir = CONTROLLER_DIR . ACP_DIR;
			$model_dir = MODEL_DIR . ACP_DIR;
		}else{
			if(isset($controller)){
				$com = $controller;
			}else{
				$com = $this->url[0];
			}

			$controller_dir = CONTROLLER_DIR;
			$model_dir = MODEL_DIR;
		}

		$file = $controller_dir . $com . '.php';

		if($this->existsController($file)){
			require_once $file;

			$this->controller = new $com;
			$this->controller->loadModel($com, $model_dir);
		}else{
			echo "Error 404";
			die();
		}
	}

	private function callControllerMethod(){
		if(strtolower($this->url[0]) === 'acp'){
			unset($this->url[0]);
		}

		echo '<pre>';
			print_r($this->url);
		echo '</pre>';

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
                echo "error 404";
                die();
            }
        }else{
            $this->controller->index();
        }
	}
}
?>