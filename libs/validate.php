<?php
/** 
 * Description of Validate 
 * 
 * @author Marcel Liebgott <Marcel@mliebgott.de> 
 * @version 1.00 
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
     * @return boolean
     */
    public static function minLength($data, $arg){ 
        if(FW_String::strlen($data) < $arg){
            return false;
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
     * @return boolean
     */
    public static function maxLength($data, $arg){ 
        if(FW_String::strlen($data) > $arg){
            return false;
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
     * @return boolean
     */
    public static function isLength($data, $arg){ 
        if(FW_String::strlen($data) !== $arg){
            return false;
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an int 
     *  
     * @access public 
     * @static
     * @param int $data 
     * @return boolean
     */
    public static function isInteger($data){
        if(!preg_match('/^-?[0-9]+$/', $data)){
            return false;
        }
          
        return true; 
    } 

    /**
     * check if integerin range
     *
     * @access public
     * @static
     * @param int $min
     * @param int $max
     * @param int $value
     * @return boolean
     */
    public static function inRange($min, $max, $value){
        if(self::isInteger($value) && self::isInteger($min) && self::isInteger($max)){
            if($value >= $min && $value <= $max){
                return true;
            }
        }

        return false;
    }
      
    /** 
     * check if input is an string 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean
     */
    public static function isString($data){
        if(!ctype_alpha($data) && !is_string($data) && !($data instanceof FW_String)){
            return false;
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an numeric 
     *  
     * @access public 
     * @static
     * @param string $data 
     * @return boolean
     */
    public static function isNumeric($data){ 
        if(!is_numeric($data)){
            return false;
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an float 
     *  
     * @access public 
     * @static
     * @param float $data 
     * @return boolean
     */
    public static function isFloat($data){ 
        if(!is_float($data)){
            return false;
        } 
          
        return true; 
    } 
      
    /** 
     * check if input is an bool 
     *  
     * @access public
     * @static
     * @param boolean $data 
     * @return boolean
     */
    public static function isBool($data){ 
        if(!is_bool($data)){
            return false;
        } 
          
        return true; 
    } 
	
	/**
	 * check if input is an boolean
	 *
	 * @access public
	 * @static
	 * @param boolean $data
	 * @return boolean
	 */
	public static function isBoolean($data){
		return self::isBool($data);
	}
      
    /** 
     * check if input is an array 
     *  
     * @access public
     * @static
     * @param array $data 
     * @param boolean $throw
     * @return boolean
     */
    public static function isArray($data, $throw = false){
        if(!is_array($data)){
        	if($throw){
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
     * @return boolean
     */
    public static function isMixed($data){
        if(preg_match('/[a-zA-Z0-9\.+\-]/u', $data)){
            return true;
        } 
          
        return false; 
    }
      
    /** 
     * check the value of a valid e-mail adress
     *  
     * @access public
     * @static
     * @param string $data 
     * @return boolean
     */
    public static function isValidMail($data){
        if(FW_Stringhelper::isValidMail($data)){
            return true;
        } 
          
        return false; 
    } 
      
    /**
     * check the value of a valid url
     *
     * @access public
     * @static
     * @param string $data
     * @return boolean
     */
    public static function isValidUrl($data){ 
        if(FW_Stringhelper::isValidUrl($data)){
            return true;
        } 
          
        return false; 
    } 
    
    /**
     * check the value of a valid date
     *
     * @access public
     * @static
     * @param string $date
     * @return boolean|string is failed
     */
    public static function isValidDate($date){
        if(!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])\.([1-9]|0[1-9]|1[0-2])\.[0-9]{4}$/', $date)){
            return false;
        }

        $daysPerMonth = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        $match = array();
        preg_match('/^(.*?)\.(.*?)\.(.*?)$/', $date, $match);

        $day = $match[1];
        $month = $match[2];
        $year = $match[3];

        if(preg_match('/^0[1-9]$/', $month)){
            $month = FW_String::substr($month, 1);
        }

        // is year an leap year
        if(($year % 400) == 0 || (($year % 4) == 0 && ($year % 100) !== 0)){
            $daysPerMonth[2] = 29;
        }

        // check days in this month
        if($daysPerMonth[$month] < $day){
            return false;
        }

        return true;
    }
} 
?>
