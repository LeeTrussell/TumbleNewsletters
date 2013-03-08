<?php
    class param
    {
        function integer($fieldname,$defaultvalue)
        {
            if(!isset($_REQUEST[$fieldname]))
            {
                return $defaultvalue;
            }
        
            return intval($_REQUEST[$fieldname]);
        }
        
        function string($fieldname, $defaultvalue)
        {
            if(!isset($_REQUEST[$fieldname]))
            {
                  return $defaultvalue;
            }
            
            $value = str_replace("\'","'",$_REQUEST[$fieldname]);
            $value = str_replace("\"",'"',$value);
            
            
            $value = htmlspecialchars($value, ENT_QUOTES);

            
            
            return $value;
        }
        
       
        
    
    
    }
?>
