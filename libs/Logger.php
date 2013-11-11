<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

class FW_Logger{
    /**
     * object instance
     *
     * @access private
     * @var instance
     */
    private static $instance = null;

    /**
     * log file
     *
     * @access private
     * @var string
     */
    private $logFile = null;

    /**
     * log path
     *
     * @access private
     * @var string
     */
    private $logPath = null;

    /**
     * get singleton instance
     *
     * @access public
     * @return instance 
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new FW_Logger();
        }

        return self::$instance;
    }
    
    /**
     * construct
     *
     * @access private
     */
    private function __construct(){
        $config = FW_Registry::getInstance()->getConfiguration();

        $this->logFile = $config->getConfig('log_file');
        $this->logPath = trim($config->getConfig('get_log_path'), '/') . '/';
    }

    /**
     * add an new log entrie in log file
     *
     * @access public
     * @param string
     */
    public function addLog($content){
        error_log(implode('|', $this->getLogContent()) . "\n", 3, $this->getLogPath() . $this->getLogFile());
    }
}

?>