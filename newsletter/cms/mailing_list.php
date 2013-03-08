<?php
  require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();

  $mailingListTemplate = new template('./templates/mailing_lists.html');
  
  $delete = $GLOBALS['param']->Integer('delete',0);
  
  if($delete)
  {
      $GLOBALS['database']->database_delete('newsletter_lists','list_id='.$delete);
      $GLOBALS['database']->database_delete('newsletter_users_lists','lists_list_id='.$delete);
      $GLOBALS['messages']->success('The list has been deleted.');
      $GLOBALS['redirect']->redirect_to('./mailing_list.php');
  
  
  }
  
  if($GLOBALS['param']->Integer('bAdd',0))
  {
      $arrMailingList = array();
      $arrMailingList['list_name'] = $GLOBALS['param']->String('mailing_list','');
      
      if($arrMailingList['list_name'] == '')
      {
         $GLOBALS['messages']->errormessage('Please give a name to your mailing list.');
      }
      
      $GLOBALS['messages']->closeError('./images/Critical.png');
      
      if($GLOBALS['messages']->isError())
      {       
          $arrReplace['form_errors'] = $GLOBALS['messages']->clearMessages();
      }
      else
      {
          $arrMailingList['list_created'] = date('Y-m-d H:i:s', time());
          $intID = $GLOBALS['database']->database_insert('newsletter_lists',$arrMailingList);
          $GLOBALS['messages']->success('Mailing List Added.'); 
          $GLOBALS['redirect']->redirect_to('./mailing_list.php');
      
      }
      
       
  }
  
  $strQuery = 'SELECT * FROM newsletter_lists order by list_delete asc, list_created desc';
  $objPagi = new pagination();
  $arrData = $objPagi->getData($strQuery, 25, 'newsletter_lists');
  $arrProcessedData = array();
  foreach($arrData as $key=>$value)
  {
     if(!strlen($value['list_description']))
     {
        $value['list_description'] = 'No Description Available.';
     }
     $value['delete_option'] = '';
     if($value['list_delete'] == 1)
     {
        $value['delete_option'] = '<a href = "?delete='.$value['list_id'].'" onclick="return confirm(\'Are you sure you wish to cancel this list?\');" ><img src = "./images/Critical.png" /></a>';
     }
     
     $strQuery = 'SELECT * FROM newsletter_users_lists where lists_list_id = ' . $value['list_id'];
     $rstCount = $GLOBALS['database']->database_query($strQuery);
     $value['number_of_members'] = $GLOBALS['database']->database_hasrows($rstCount);
     
     
     
     $arrProcessedData[] = $value;
  }
  $arrReplace['LIST_OF_MAILING_LISTS']  = $objPagi->returnTemplatedData('./templates/lists_item.html', $arrProcessedData);
  $arrReplace['pagination'] = $objPagi->getPaginationNaviBar();
  
  
  $arrReplace['form_errors'] = $GLOBALS['messages']->clearMessages();
  $mailingListTemplate->replacevars($arrReplace);
  $indexTemplate->replacevars(array('content'=>$mailingListTemplate->returnTemplate(),'menu'=>$GLOBALS['menu']->drawMenu('mailing-list')));
  echo $indexTemplate->returnTemplate();
  
?>