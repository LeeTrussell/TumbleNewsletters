<?php
  require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();

  $mailingListTemplate = new template('./templates/users.html');
  
  $delete = $GLOBALS['param']->Integer('delete',0);
  $download = $GLOBALS['param']->Integer('download',0);
  

  
          if($download)
          {
             $strQuery = 'SELECT * FROM newsletter_users_lists LEFT JOIN newsletter_subscribers ON lists_user_id = subscribe_id where lists_list_id = ' . $download;
             $rstUsers = $GLOBALS['database']->database_query($strQuery);
             
             $strList = '';
             if($GLOBALS['database']->database_hasrows($rstUsers))
             {
                while($arrUser = $GLOBALS['database']->database_fetch($rstUsers))
                {
                    $strList .= $arrUser['subscribe_email'].",\n";
                

                }
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=exportevent.csv");  
header("Pragma: no-cache");  
header("Expires: 0");  
                echo $strList;
                exit();
             } 
          
          
          }
  
  
  
  if($delete)
  {
    $GLOBALS['database']->database_delete('newsletter_subscribers','subscribe_id='.$delete);
    $GLOBALS['database']->database_delete('newsletter_users_lists','lists_user_id='.$delete);
    $GLOBALS['database']->database_delete('newsletter_to_send','send_user='.$delete);
    $GLOBALS['messages']->success('Subscriber successfully deleted.');
    $GLOBALS['redirect']->redirect_to('./users.php');
  
  }
  
  if($GLOBALS['param']->Integer('bAdd',0))
  {
     $arrSubscribe['subscribe_email'] = $GLOBALS['param']->String('subscribe_email','');
     
     if(!isEmailValid($arrSubscribe['subscribe_email']))
     {
        $GLOBALS['messages']->errormessage('Invalid E-Mail Address.');   
     }
     
     $GLOBALS['messages']->closeError('./images/Critical.png');
      
      if($GLOBALS['messages']->isError())
      {       
          $arrReplace['form_errors'] = $GLOBALS['messages']->clearMessages();
      }else
      {
          $arrSubscribe['subscribe_created'] = date('Y-m-d H:i:s', time());
          $intID = $GLOBALS['database']->database_insert('newsletter_subscribers',$arrSubscribe);
          
          for($i = 0; $i < count($_POST['lists']); $i++)
          {
             $arrSendTo[$i] = $_POST['lists'][$i];                   
             $GLOBALS['database']->database_insert('newsletter_users_lists',array('lists_user_id'=>$intID,'lists_list_id'=>$arrSendTo[$i]));
                      
          }
          
          $GLOBALS['messages']->success('Subscriber successfully added.');
          $GLOBALS['redirect']->redirect_to('./users.php');    
      
      
      }
     
     
  }
  
  $strQuery = 'SELECT * FROM newsletter_lists ORDER BY list_delete asc';
  $rstLists = $GLOBALS['database']->database_query($strQuery);
   
   $strQuery = 'SELECT * FROM newsletter_lists where list_delete = 0';
   $rstNoDel = $GLOBALS['database']->database_query($strQuery);
   $arrNoDel = $GLOBALS['database']->database_fetch($rstNoDel);
   
   $filter = $GLOBALS['param']->Integer('filter',$arrNoDel['list_id']);
  if($GLOBALS['database']->database_hasrows($rstLists))
  {
        
        
        $strSelect = '<select id="lists" class="multiselect" multiple="multiple" name="lists[]">';
        $strFilter = '<select id = "filter" name = "filter">';
        while($arrList = $GLOBALS['database']->database_fetch($rstLists))
        {
            $strSelect .= '<option value = "'.$arrList['list_id'].'">'.$arrList['list_name'].'</option>';
            $strAddFilter = '';
            
            if($filter == $arrList['list_id'])
            {
                $strAddFilter = ' selected = "selected" ';
            }
            
            $strFilter .= '<option '.$strAddFilter.' value = "'.$arrList['list_id'].'">'.$arrList['list_name'].'</option>';
        
        }
  
        $strSelect .= '</select>';
        $strFilter .= '</select>';
        $arrReplace['SELECT_LIST'] = $strSelect;
        $arrReplace['SELECT_FILTER'] = $strFilter;
  
  }
  
 
  
  if($filter)
  {
      $strQuery = 'SELECT * FROM newsletter_users_lists LEFT JOIN newsletter_subscribers ON subscribe_id = lists_user_id where lists_list_id = '.$filter.' order by subscribe_created desc';
  }
  else
  {
     $strQuery = 'SELECT * FROM newsletter_subscribers order by subscribe_created desc';
  } 
  

  $objPagi = new pagination();
  $arrData = $objPagi->getData($strQuery, 25, 'newsletter_subscribers');
  $arrProcessedData = array();
  foreach($arrData as $key=>$value)
  {
     
     
     
     
     $arrProcessedData[] = $value;
  }
  $arrReplace['LIST_OF_USERS']  = $objPagi->returnTemplatedData('./templates/subscriber_item.html', $arrProcessedData);
  $arrReplace['pagination'] = $objPagi->getPaginationNaviBar();
  $arrReplace['filter'] = $filter;
  
  
  $mailingListTemplate->replacevars($arrReplace);
  $indexTemplate->replacevars(array('content'=>$mailingListTemplate->returnTemplate(),'menu'=>$GLOBALS['menu']->drawMenu('subscribers')));
  echo $indexTemplate->returnTemplate();
  
?>