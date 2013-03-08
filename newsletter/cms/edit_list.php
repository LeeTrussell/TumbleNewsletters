<?php
  require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();

  $editListTemplate = new template('./templates/edit_list.html');
  
  $edit = $GLOBALS['param']->Integer('edit',0);
  
  if($edit)
  {
      $strQuery = 'SELECT * FROM newsletter_lists WHERE list_id = ' . $edit;
      $rstEdit = $GLOBALS['database']->database_query($strQuery);
      $arrEdit = $GLOBALS['database']->database_fetch($rstEdit);
      
      $strQuery = 'SELECT * FROM newsletter_users_lists WHERE lists_list_id = ' . $edit;
      $rstUsers = $GLOBALS['database']->database_query($strQuery);
      $arrListOfMembers = array();
      if($GLOBALS['database']->database_hasrows($rstUsers))
      {
          while($arrUser = $GLOBALS['database']->database_fetch($rstUsers))
          {
             $arrListOfMembers[$arrUser['lists_user_id']] = 1;
          }
      }
        
  }
  
  

  
  if($GLOBALS['param']->Integer('bSubmit',0))
  {
     $arrEdit['list_name'] = $GLOBALS['param']->String('list_name','');
     $arrEdit['list_description'] = $GLOBALS['param']->String('list_description','');
     
     if($arrEdit['list_name'] == '')
     {
        $GLOBALS['messages']->errormessage('Please provide a name for this mailing list.');     
     }
          $arrListOfMembers = array();
          for($i = 0; $i < count($_POST['subscribers']); $i++)
          {
              $arrListOfMembers[$_POST['subscribers'][$i]] = 1;                                    
          }


      $GLOBALS['messages']->closeError('./images/Critical.png');
      
      if($GLOBALS['messages']->isError())
      {       
          $arrReplace['form_errors'] = $GLOBALS['messages']->clearMessages();
      }
      else
      {
          $GLOBALS['database']->database_update('newsletter_lists',$arrEdit,'list_id',$arrEdit['list_id']);
          /*Get a list of subscribers*/
          $GLOBALS['database']->database_delete('newsletter_users_lists','lists_list_id = ' . $arrEdit['list_id']);
          for($i = 0; $i < count($_POST['subscribers']); $i++)
          {
                $GLOBALS['database']->database_insert('newsletter_users_lists',array('lists_list_id'=>$edit,'lists_user_id'=>$_POST['subscribers'][$i]));                    
          }
          
          $GLOBALS['messages']->success('The list has been updated.');
          $GLOBALS['redirect']->redirect_to('./mailing_list.php');
      
      }            
  
  }
  
  $strQuery = 'SELECT * FROM newsletter_subscribers';
  $rstSubscribers = $GLOBALS['database']->database_query($strQuery);
  if($GLOBALS['database']->database_hasrows($rstSubscribers))
  {
     $strSelect = '<select id="subscribers" class="multiselect" multiple="multiple" name="subscribers[]">';
     while($arrSubscriber = $GLOBALS['database']->database_fetch($rstSubscribers))
     {
        
        $strSelected = '';
        if(isset($arrListOfMembers[$arrSubscriber['subscribe_id']]))
        {
          $strSelected = ' selected = "selected" ';
        }
        
        $strSelect .= '<option value = "'.$arrSubscriber['subscribe_id'].'" '.$strSelected.'>'.$arrSubscriber['subscribe_email'].'</option>';
     }
     $strSelect .= '</select>';
     $arrReplace['selected_emails'] = $strSelect;
  }  
  
  $editListTemplate->replacevars($arrReplace);
  $editListTemplate->replacevars($arrEdit);
  $indexTemplate->replacevars(array('content'=>$editListTemplate->returnTemplate(),'menu'=>$GLOBALS['menu']->drawMenu('mailing-list')));
  echo $indexTemplate->returnTemplate();
  
  
  
?>