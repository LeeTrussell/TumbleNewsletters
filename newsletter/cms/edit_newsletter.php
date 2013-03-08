<?php
 require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();
  $objWysiwig = new wysiwig('../ckeditor/');
  $newsletterEdit = new template('./templates/edit_newsletter.html');
  $arrNewsletter = array('newsletter_title'=>'','newsletter_content'=>'', 'newsletter_description'=>'');
  
  $edit = $GLOBALS['param']->Integer('edit',0);
  $arrReplace['NEWSLETTER_ADD_OR_EDIT'] = 'Add New Template.';
  
  
  if($edit)
  {
      $strQuery = 'SELECT * FROM newsletter_newsletters where newsletter_id = ' . $edit;
      $rstNewsletter = $GLOBALS['database']->database_query($strQuery);
      $arrNewsletter = $GLOBALS['database']->database_fetch($rstNewsletter);
      $arrReplace['NEWSLETTER_ADD_OR_EDIT'] = 'Editing Template \''.$arrNewsletter['newsletter_title'].'\'';
               
  }
  
  if($GLOBALS['param']->Integer('bSubmit',0))
  {
      $arrNewsletter['newsletter_title'] = $GLOBALS['param']->String('newsletter_title','');
      $arrNewsletter['newsletter_description'] = $GLOBALS['param']->String('newsletter_description','');
      $arrNewsletter['newsletter_content'] = $GLOBALS['param']->String('newsletter_content','');
      
      if($arrNewsletter['newsletter_title'] == '')
      {
         $GLOBALS['messages']->errormessage('Please provide a title.');
      }
  
      $GLOBALS['messages']->closeError('./images/Critical.png');
      
      if($GLOBALS['messages']->isError())
      {
          $arrNewsletter['form_errors'] = $GLOBALS['messages']->clearMessages();
      }
      else
      {
          if($edit)
          {
              $GLOBALS['database']->database_update('newsletter_newsletters',$arrNewsletter,'newsletter_id',$arrNewsletter['newsletter_id']);
              $GLOBALS['messages']->success('Template successfully edited.');
          }
          else
          {
              
              $arrNewsletter['newsletter_created'] = date('Y-m-d H:i:s', time());
              $GLOBALS['database']->database_insert('newsletter_newsletters',$arrNewsletter);
              $GLOBALS['messages']->success('Template successfully added.');          
          }
          
          $GLOBALS['redirect']->redirect_to('./newsletters.php');
      
      }
      
  
  }
  
  $arrReplace['edit_id'] = $edit;
  $newsletterEdit->replacevars($arrReplace);
  $newsletterEdit->replacevars($arrNewsletter);
  $indexTemplate->replacevars(array( 'ckeditor_head'=>$objWysiwig->AddHeader(),'content'=>$newsletterEdit->returnTemplate(),'menu'=>$GLOBALS['menu']->drawMenu('html-emails'),'wysiwig_instance1'=>$objWysiwig->addWysiwig($arrNewsletter['newsletter_content'],'newsletter_content','newsletter_content','./style.css')));
  echo $indexTemplate->returnTemplate();
  
  
  
?>