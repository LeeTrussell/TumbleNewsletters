<?php
       class messages
       {
            protected $boolError;
       
            function __construct()
            {
                $this->boolError = false;
                //$_SESSION['output_messages'] = '';
                if(!isset($_SESSION['output_messages']))
                {
                    $_SESSION['output_messages'] = '';
                }  
            }
       
       
            function success($message)
            {
                $_SESSION['output_messages'] = '<div class = "success"><p>'.$message.'</p></div>';
            }
            
            function errormessage($message)
            {
                $this->boolError = true;
                $_SESSION['output_messages'] .= '<li>'.$message.'</li>';
            }
            
            function isError()
            {
                return $this->boolError;
            }
       
            function closeError($strImage = './tumble_images/tooltips/Critical.png', $strErrorMsg = 'The form contains the following errors...')
            {
                  if($this->boolError == true)
                  {
                    $_SESSION['output_messages'] = '<div class = "errorlist"><img src = "'.$strImage.'" /><div class="errorlist_messages"><p>'.$strErrorMsg.'</p><ul>'.$_SESSION['output_messages'].'</ul></div></div>';
                  }
             }
             
             function clearMessages()
             {
                
                $strContents = '';
                if(isset($_SESSION['output_messages']))
                {
                  $strContents = $_SESSION['output_messages'];
                
                unset($_SESSION['output_messages']);
                }
                return $strContents;
             }
 
       
       
       
       }
?>
