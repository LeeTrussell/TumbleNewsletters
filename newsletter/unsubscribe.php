<?php
      require('application.php');
      
      $strEmail = $GLOBALS['param']->String('email','');
      
      
      $strQuery = 'SELECT * FROM newsletter_subscribers where subscribe_email = \''.$strEmail.'\'';

      $rstUser = $GLOBALS['database']->database_query($strQuery);
      
      if($GLOBALS['database']->database_hasrows($rstUser))
      {
            while($arrUser = $GLOBALS['database']->database_fetch($rstUser))
            {
                    $GLOBALS['database']->database_delete('newsletter_subscribers','subscribe_id='.$arrUser['subscribe_id']);
                    $GLOBALS['database']->database_delete('newsletter_users_lists','lists_user_id='.$arrUser['subscribe_id']);
                    $GLOBALS['database']->database_delete('newsletter_to_send','send_user='.$arrUser['subscribe_id']);

            
            
            
            }
      
      
      
      
      }
      
    echo 'You have been removed from the E-Mail list.';
                  
      
      
?>