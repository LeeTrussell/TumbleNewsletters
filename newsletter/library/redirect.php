<?php
    class redirect{
    
            function redirect_to($strUrl = '')
            {
                header('Location: ' . $strUrl);
                exit();  
            }
    
    }
?>
