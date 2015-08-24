<?php   
if(!defined('PATH')){ 
    die("No direct script access allowed"); 
} 
  
/** 
 * Description of Validate 
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de> 
 * @since 1.00 
 * @package mvc 
 * @subpackage libs 
 */
  
final class FW_Validate{      
    /** 
     * check the min length of an string 
     *  
     * @access public
     * @static
     * @param string $data 
     * @param int $arg 
     * @return boolean|array if failed
     */
    public static function minLength($data, $arg){ 
        if(FW_String::strlen($data) < $arg){
            throw new FW_Exception_WrongParameter(array('message' => 'min_length', 'arg' => $arg));
        } 
          
        return true; 
    } 
      
    /** 
     * check the max length of an string 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @param int $arg 
     * @return boolean|array if failed
     */
    public static function maxLength($data, $arg){ 
        if(FW_String::strlen($data) > $arg){
            throw new FW_Exception_WrongParameter(array('message' => 'max_length', 'arg' => $arg)); 
        } 
          
        return true; 
    } 
      
    /** 
     * check the data of his length 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @param int $arg 
     * @return boolean|array if failed
     */
    public static function isLength($data, $arg){ 
        if(FW_String::strlen($data) !== $arg){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_long', 'arg' => $arg));
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an int 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean|string if failed
     */
    public static function isInteger($data){ 
        if(!is_integer($data)){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_integer'));
        } 
          
        return true; 
    } 

    /**
     * check if integerin range
     *
     * @access public
     * @static
     * @param int
     * @param int
     * @param int
     * @return boolean|string is failed
     */
    public static function inRange($min, $max, $value){
        if($this->isInteger($value) && $this->isInteger($min) && $this->isInteger($max)){
            if($value >= $min && $value <= $max){
                return true;
            }else{
                throw new FW_Exception_WrongParameter(array('message' => 'not_in_range'));
            }
        }
    }
      
    /** 
     * check if input is an string 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean|string is failed
     */
    public static function isString($data){
        if(!ctype_alpha($data) && !is_string($data) && !($data instanceof FW_String)){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_string'));
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an numeric 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean|string is failed
     */
    public static function isNumeric($data){ 
        if(!is_numeric($data)){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_numberic'));
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an float 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean|string is failed
     */
    public static function isFloat($data){ 
        if(!is_float($data)){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_float'));
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an bool 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean|string is failed
     */
    public static function isBool($data){ 
        if(!is_bool($data)){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_boolean'));
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an array 
     *  
     * @access public 
     * @static
     * @param array $data 
     * @return boolean|string is failed
     */
    public static function isArray($data, $throws = true){
        if(!is_array($data)){
            if($throws){
                throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_array'));
            }else{
                return false;
            }
        } 
          
        return true; 
    } 
      
    /** 
     * checked if the input has an mixed value 
     *  
     * @access public 
     * @static
     * @param mixed $data 
     * @return boolean|string is failed
     */
    public static function isMixed($data){
        if(!preg_match('/[a-zA-Z0-9\.+\- ]/i', $data)){
            throw new FW_Exception_WrongParameter(array('message' => 'must_be_a_mixed'));
        } 
          
        return true; 
    }
      
    /** 
     * check the value of a valid e-mail adress
     *  
     * @access public
     * @static
     * @param type $data 
     * @return boolean|string is failed
     */
    public static function isValidMail($data){ 
        if(!FW_Stringhelper::isValidMail($data)){
            throw new FW_Exception_WrongParameter(array('message' => 'mail_not_valid'));
        } 
          
        return true; 
    } 
      
    /**
     * check the value of a valid url
     *
     * @access public
     * @static
     * @param string $data
     * @return boolean|string is failed
     */
    public static function isValidUrl($data){ 
        if(!FW_Stringhelper::isValidUrl($data)){
            throw new FW_Exception_WrongParameter(array('message' => 'url_not_valid'));
        } 
          
        return true; 
    } 
    
    /**
     * check the value of a valid date
     *
     * @access public
     * @static
     * @param string date
     * @return boolean|string is failed
     */
    public static function isValidDate($date){
        if(!preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $date)){
            throw new FW_Exception_WrongParameter(array('message' => 'not_valid_date'));
        }

        $daysPerMonth = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        preg_match('/^(.*?)\.(.*?)\.(.*?)$/', $date, $match);

        if(count($match) == 4){
            $day = $match[1];
            $month = $match[2];
            $year = $match[3];

            // valid parts of this date
            if($day == 0 || $month == 0){
                throw new FW_Exception_WrongParameter(array('message' => 'not_valid_date'));
            }

            // is year an leap year
            if(($year % 400) == 0 || (($year % 4) == 0 && ($year % 100) !== 0)){
                $daysPerMonth[2] = 29;
            }

            // check days in this month
            if($daysPerMonth[$month] < $day){
                throw new FW_Exception_WrongParameter(array('message' => 'not_valid_date'));
            }

            return true;
        }
    }
} 
  
?>