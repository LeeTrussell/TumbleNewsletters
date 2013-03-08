<?php
  require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();

  $newslettersListTemplate = new template('./templates/newsletters.html');
  
  $delete = $GLOBALS['param']->Integer('delete',0);
  
  if($delete)
  {
     $GLOBALS['database']->database_delete('newsletter_newsletters','newsletter_id='.$delete);
     $GLOBALS['messages']->success('Template Deleted.');
     $GLOBALS['redirect']->redirect_to('./newsletters.php');
  
  }
  
  

  $strQuery = 'SELECT * FROM newsletter_newsletters';
  $objPagi = new pagination();
  $arrData = $objPagi->getData($strQuery, 25, 'newsletter_newsletters');
  $arrProcessedData = array();
  foreach($arrData as $key=>$value)
  {
    
     
     $arrProcessedData[] = $value;
  }
  $arrReplace['LIST_OF_NEWSLETTERS']  = $objPagi->returnTemplatedData('./templates/newsletter_item.html', $arrProcessedData);
  $arrReplace['pagination'] = $objPagi->getPaginationNaviBar();
  
  
  $arrReplace['FORM_ERRORS'] = $GLOBALS['messages']->clearMessages();
  $newslettersListTemplate->replacevars($arrReplace);
  $indexTemplate->replacevars(array('content'=>$newslettersListTemplate->returnTemplate(),'menu'=>$GLOBALS['menu']->drawMenu('html-emails')));
  echo $indexTemplate->returnTemplate();
  
?>