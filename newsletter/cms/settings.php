<?php
 require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();
  $objWysiwig = new wysiwig('../ckeditor/');
  $settingsTemplate = new template('./templates/settings.html');
  //$arrNewsletter = array('newsletter_title'=>'','newsletter_content'=>'', 'newsletter_description'=>'');

  $strQuery =  'SELECT * FROM newsletter_login';
  $rstLogin = $GLOBALS['database']->database_query($strQuery);
  $arrLogin = $GLOBALS['database']->database_fetch($rstLogin);
  
  $strQuery = 'SELECT * FROM newsletter_settings where settings_id = 1';
  $rstSettings = $GLOBALS['database']->database_query($strQuery);
  $arrSMTPSettings = $GLOBALS['database']->database_fetch($rstSettings);
  
  

  
  if($GLOBALS['param']->Integer('bSettings',0))
  {
     
     $strPassword = $arrLogin['user_password'];
     $arrLogin['user_username'] = $GLOBALS['param']->String('user_username','');
     $arrLogin['user_password'] = $GLOBALS['param']->String('user_password','');
     
     if(strlen($arrLogin['user_password']))
     {
          $arrLogin['user_password'] = crypt($arrLogin['user_password'],$arrLogin['user_seed']);
          $GLOBALS['login']->login($arrLogin['user_username'],$arrLogin['user_password']);     
     }else
     {
          
          unset($arrLogin['user_password']);
          $GLOBALS['login']->login($arrLogin['user_username'],$strPassword);
     }
     
     $GLOBALS['database']->database_update('newsletter_login',$arrLogin,'user_id',$arrLogin['user_id']);
     $GLOBALS['messages']->success('User details updated successfully.');
     
     $GLOBALS['redirect']->redirect_to('./settings.php');
  
  }
  
  if($GLOBALS['param']->Integer('smtpsettings',0))
  {
     $arrSMTPSettings['smtp_host'] = $GLOBALS['param']->String('smtp_host','');
     $arrSMTPSettings['smtp_port'] = $GLOBALS['param']->String('smtp_port','');
     $arrSMTPSettings['smtp_username'] = $GLOBALS['param']->String('smtp_username','');
     $arrSMTPSettings['smtp_password'] = $GLOBALS['param']->String('smtp_password','');
     $arrSMTPSettings['smtp_from'] = $GLOBALS['param']->String('smtp_from','');
     $GLOBALS['database']->database_update('newsletter_settings',$arrSMTPSettings,'settings_id',1);
     $GLOBALS['messages']->success('SMTP details updated successfully.');
     $GLOBALS['redirect']->redirect_to('./settings.php');
  
  }
  
  
  $settingsTemplate->replacevars(array('form_errors'=>$GLOBALS['messages']->clearMessages()));
  $settingsTemplate->replacevars($arrSMTPSettings);
  $settingsTemplate->replacevars($arrLogin);
  $indexTemplate->replacevars(array( 'ckeditor_head'=>$objWysiwig->AddHeader(),'content'=>$settingsTemplate->returnTemplate(),'menu'=>$GLOBALS['menu']->drawMenu('Settings')));
  echo $indexTemplate->returnTemplate();
  
  
  
?>