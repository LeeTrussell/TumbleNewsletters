<?php
   require('application.php');
   
   
   
   $loginTemplate = new template('./templates/login.html');
   $arrReplace = array('form_errors'=>'');
   if($GLOBALS['param']->Integer('bLogin',''))
   {

      $strUsername = $GLOBALS['param']->String('user_username','');
      $strPassword = $GLOBALS['param']->String('user_password','');
      
      $strQuery = 'SELECT * FROM newsletter_login where user_username = \''.$strUsername.'\'';
      $rstUser = $GLOBALS['database']->database_query($strQuery);
      if($GLOBALS['database']->database_hasrows($rstUser))
      {
          $arrUserDetails = $GLOBALS['database']->database_fetch($rstUser);
         
         if(crypt($strPassword,$arrUserDetails['user_seed']) == $arrUserDetails['user_password'])
         {
         
              $GLOBALS['login']->login($strUsername, $arrUserDetails['user_password']);
              $GLOBALS['redirect']->redirect_to('./mailing_list.php');
        }
        else
        {
             $GLOBALS['messages']->errormessage('Invalid username/password combination.');
        }
      }
      else
      {
        $GLOBALS['messages']->errormessage('Invalid username/password combination.');
      }
      
      $GLOBALS['messages']->closeError('./images/Critical.png');
      $arrReplace['form_errors'] = $GLOBALS['messages']->clearMessages();
   }
        
   
   
   
   
   $loginTemplate->replacevars($arrReplace);
   $indexTemplate->replacevars(array('content'=>$loginTemplate->returnTemplate()));
   echo $indexTemplate->returnTemplate();
   
   
   
?>
