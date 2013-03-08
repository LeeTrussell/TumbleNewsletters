<?php
      require('application.php');
      
      
      if($GLOBALS['param']->Integer('bSubmit',0))
      {
            $arrSubscribe['subscribe_email'] = $GLOBALS['param']->String('email','');
            $arrSubscribe['subscribe_created'] = date('Y-m-d H:i:s',time());
            
            if(!isemailvalid($arrSubscribe['subscribe_email']))
            {
                echo 0;
                exit();            
            }
            
            $intID = $GLOBALS['database']->database_insert('newsletter_subscribers',$arrSubscribe);
            $strQuery = 'SELECT * FROM newsletter_lists where list_delete = 0';
            $rstList = $GLOBALS['database']->database_query($strQuery);
            $arrList = $GLOBALS['database']->database_fetch($rstList);
            
            
            $arrAddGroup['lists_user_id'] = $intID;
            $arrAddGroup['lists_list_id'] = $arrList['list_id'];
            $GLOBALS['database']->database_insert('newsletter_users_lists',$arrAddGroup);
            
            
            
            
            echo 1;
            exit();
            
      
      
      }
      
      
      
      
?>