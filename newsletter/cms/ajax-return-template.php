<?php
  require('application.php');
  
  $templateID = $GLOBALS['param']->Integer('template',0);
  
  if($templateID)
  {
      $strQuery = 'SELECT * FROM newsletter_newsletters where newsletter_id = ' . $templateID;
      
      $rstTemplate = $GLOBALS['database']->database_query($strQuery);
      $arrTemplate = $GLOBALS['database']->database_fetch($rstTemplate);
      
      echo htmlspecialchars_decode($arrTemplate['newsletter_content']);
  
  
  
  
  }
  
  
  
?>