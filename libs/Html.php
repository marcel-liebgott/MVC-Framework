<?php

if(!defined('PATH')){
    die("No direct script access allowed");
}

/**
 * Description of HTML
 *
 * @author Marcel Liebgott <Marcel@mliebgott.de>
 * @since 1.00
 * @package mvc
 * @subpackage libs
 */

class FW_Html{
    private $val;
    
    public function __construct(){
        $this->val = new FW_Validate();
    }
    
    /**
     * add an textbox
     * 
     * @access public
     * @param string $name
     * @param int $size
     * @param int $maxlenght
     * @param string $css_class
     * @param string $id
     * @param string $value
     * @param string $placeholder
     * @param string $event
     * @param string $eventhandler
     */
    public function addTextBox($name, $size = 30, $maxlenght = 0, $css_class = null, $id = null, $value = null, $placeholder = null, $event = null, $eventhandler = null){
        $html = '<input type="text" name="' . $name . '" ';
        
        if($this->val->isInteger($size) == true && $size !== null && $size > 0){
            $html .= 'size="' . $size . '" ';
        }else{
            $html .= 'size="30" ';
        }
        
        if($maxlenght > 0 && $maxlenght !== null){
            if($this->val->isInteger($maxlenght) == null){
                $html .= 'maxlenght="' . $maxlenght . '" ';
            }            
        }
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        if($value !== null){
            $html .= 'value="' . $value . '" ';
        }
        
        if($event !== null && $eventhandler !== null){
            $html .= $event . '="' . $onclick . '"';
        }
        
        if($placeholder !== null){
            $html .= 'placeholder="' . $placeholder . '" ';
        }
        
        $html .= ">";
        
        return $html;
    }
    
    /**
     * add an password textbox
     * 
     * @access public
     * @param string $name
     * @param int $size
     * @param int $maxlenght
     * @param string $css_class
     * @param string $id
     * @param string $onclick
     */
    public function addPasswordBox($name, $size = 30, $maxlenght = 0, $css_class = null, $id = null, $onclick = null){
        $html = '<input type="password" name="' . $name . '" ';
        
        if($this->val->isInteger($size) == true){
            $html .= 'size="' . $size . '" ';
        }
        
        if($maxlenght > 0){
            if($this->val->isInteger($maxlenght) == null){
                $html .= 'maxlenght="' . $maxlenght . '" ';
            }            
        }
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        if($onclick !== null){
            $html .= 'onclick="' . $onclick . '"';
        }
        
        $html .= ">";
        
        return $html;
    }
    
    /**
     * add a radio group with yes an no
     * 
     * @access public
     * @param string $name
     * @param string $css_class
     * @param string $id
     * @return type
     */
    public function addRadioYesNo($name, $css_class = null, $id = null, $checked = null){
        $html = '<input type="radio" name="' . $name . '" ';
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        
        
        if($checked != null){
            if($checked == (int) true){
                $yes = $html . ' value="1" checked="checked"> ja<br>';
                $no = $html . ' value="0"> nein<br>';
            }else{
                $yes = $html . ' value="1"> ja<br>';
                $no = $html . ' value="0" checked="checked"> nein<br>';
            }
        }else{
            $yes = $html . ' value="1"> ja<br>';
            $no = $html . ' value="0"> nein<br>';
        }
        
        return $yes . $no;
    }
    
    /**
     * add a radio group
     * 
     * @param string $name
     * @param string $css_class
     * @param string $id
     * @param array $data
     * <var>
     *  array(
     *      [value1] => name1,
     *      [value2] => name2,
     *      ...
     *  )
     * </var>
     * @param boolean $linebreak
     */
    public function addRadioGroup($_name, $css_class = null, $id = null, array $data, $linebreak = true){
        $html = null;
        
        foreach($data as $value => $name){
            $html .= '<input type="radio" name="' . $_name . '" ';
            
            if($css_class !== null){
                $html .= 'class="' . $css_class . '" ';
            }
            
            if($id !== null){
                $html .= 'id="' . $id . '" ';
            }
            
            $html .= 'value="' . $value . '"> ' . $name;
            
            if($linebreak == true){
                $html .= '<br>';
            }else{
                $html .= ' ';
            }
        }
        
        return $html;
    }
    
    /**
     * add a selection list
     * 
     * @access public
     * @param string $name
     * @param int $size
     * @param string $css_class
     * @param string $id
     * @param array $data
     * @param string $select
     * @param boolean $multiple
     * @return string
     */
    public function addSelectList($name, $size = 5, $css_class = null, $id = null, array $data, $select = null, $multiple = false){
        if($this->val->isInteger($size) == null){
            $html = '<select name="' . $name . '" size="' . $size . '" ';
            
            if($multiple == true){
                $html .= 'multiple><br>';
            }else{
                $html .= '><br>';
            }
        
            foreach($data as $value){
                if($select !== null && $select === $value){
                    $html .= '<option selected>' . $value . '</option><br>';
                }else{
                    $html .= '<option>' . $value . '</option><br>';
                }
            }
            
            $html .= '</select>';
            
            return $html;
        }
    }
    
    /**
     * add an textarea
     * 
     * @access public 
     * @param string $name
     * @param int $rows
     * @param int $cols
     * @param string $css_class
     * @param string $text
     * @return string $html
     */
    public function addTextArea($name, $rows = 10, $cols = 50, $css_class = null, $id = null, $text = null){
        $html = '<textarea name="' . $name . '" ';
        if($this->val->isInteger($rows) == null && $this->val->isInteger($cols) == null){
            $html .= 'cols="' . $cols . '" rows="' . $rows . '" ';
        }
            
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }

        if($id !== null){
            $html .= 'id="' . $id . '">';
        }

        if($text !== null){
            $html .= $text;
        }

        $html .= '</textarea>';

        return $html;
    }
    
    /**
     * add an hidden field
     * 
     * @access public
     * @param string $name
     * @param string $css_class
     * @param string $id
     * @param string $value
     * @return string $html
     */
    public function addHidden($name, $css_class = null, $id = null, $value = null){
        $html = '<input type="hidden" name="' . $name . "'";
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . "' ";
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '"';
        }
        
        if($value !== null){
            $html .= 'value="' . $value . '" ';
        }
        
        $html .= '>'; 
    }
    
    /**
     * add checkbockes
     * 
     * @access public
     * @param string $name
     * @param string $css_class
     * @param string $id
     * @param array $data
     * <var>
     *  array(
     *      [value1] => name1,
     *      [value2] => name2,
     *      ...
     *  )
     * </var>
     * @param boolean $linebreak
     * @return string $html
     */
    public function addCheckbox($_name, $css_class = null, $id = null, array $data, $linebreak = true){
        if($this->val->isArray($data)){
            $html = null;
            
            foreach($data as $value => $name){
                $html .= '<input type="checkbox" name="' . $_name . '" ';
                
                if($css_class !== null){
                    $html .= 'class="' . $css_class . '" ';
                }
                
                if($id !== null){
                    $html .= 'id="' . $id . '" ';
                }
                
                $html .= 'value="' . $value . '"> ' . $name;
                
                if($linebreak == true){
                    $html .= '<br>';
                }else{
                    $html .= ' ';
                }
            }
            
            return $html;
        }
    }
    
    /**
     * add an submit button
     * 
     * @access public
     * @param string $name
     * @param string $css_class
     * @param string $id
     * @param string $value
     * @return string $html
     */
    public function addSubmit($name, $css_class = null, $id = null, $value = null){
        $html = '<button type="submit" name="' . $name . '" ';
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        if($value !== null){
            $html .= '>' . $value . '</button>';
        }
        
        
        
        return $html;
    }
    
    /**
     * add an reset button
     * 
     * @access public
     * @param string $name
     * @param string $css_class
     * @param string $id
     * @param string $value
     * @return string $html
     */
    public function addReset($name, $css_class = null, $id = null, $value = null){
        $html = '<input type="reset" name="' . $name . '" ';
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        if($value !== null){
            $html .= 'value="' . $value . '"';
        }
        
        $html .= '>';
        
        return $html;
    }
    
    /**
     * add an button
     * 
     * @access public
     * @param string $name
     * @param string $value
     * @param string $css_class
     * @param string $id
     * @return string $html
     */
    public function addButton($name, $value, $css_class = null, $id = null){
        $html = '<button type="button" name="' . $name . '" ';
        
        if($css_class !== null){
            $html .= 'class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        
        $html .= '>' . $value . '</button>';
        
        return $html;
    }
    
    public function addFileBox($name, $accept_type, $accept_detail = '*', $css_class = null, $id = null){
        $html = '<input type="file" name="' . $name . '" accept="' . $accept_type . '/' . $accept_detail . '" ';
        
        if($css_class !== null){
            $html .= ' class="' . $css_class . '" ';
        }
        
        if($id !== null){
            $html .= 'id="' . $id . '" ';
        }
        
        $html .= '>';
        
        return $html;
    }
    
    /**
     * generate a list
     * 
     * @access public
     * @param string $id_ul
     * @param string $class_ul
     * @param string $id_li
     * @param string $class_li
     * @param array $data
     * @return string
     */
    public function addList($id_ul, $class_ul, $id_li, $class_li, array $data){
        $html = '<ul';
        
        if($id_ul !== null){
            $html .= ' id="' . $id_ul . '" ';
        }
        
        if($class_ul !== null){
            $html .= ' class="' . $class_ul . '" ';
        }
        
        $html .= '>';
        
        foreach($data as $key => $value){
            $html .= '<li';
            
            if($id_li !== null){
                $html .= ' id="' . $id_li . '" ';
            }else{
                $html .= ' id="' . $key . '" ';
            }
            
            if($class_li !== null){
                $html .= 'class="' . $class_li . '" ';
            }
            
            $html .= '>' . $value . '</li>';
        }
        
        $html .= '</ul>';
        
        return $html;
    }
}

?>
