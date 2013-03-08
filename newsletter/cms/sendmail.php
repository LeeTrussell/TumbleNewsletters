<?php
  require('application.php');
  
  $GLOBALS['login']->checkLogin('./index.php',array(1));
  $arrReplace = array();

  $sendMailTemplate = new template('./templates/send_mail.html');
  $objWysiwig = new wysiwig('../ckeditor/');
  $cancel = $GLOBALS['param']->Integer('delete',0);
  
  if($cancel)
  {
        $GLOBALS['database']->database_delete('newsletter_to_send','send_campaign='.$cancel);
        $GLOBALS['database']->database_delete('newsletter_send_lists','sending_campaign='.$cancel);
        $GLOBALS['database']->database_delete('newsletter_mailing_campaigns','mail_id='.$cancel);
        
        $GLOBALS['messages']->success('Mailing campaign deleted.');
        $GLOBALS['redirect']->redirect_to('./sendmail.php');
  
  }
  
  
  
  $strQuery= 'SELECT * FROM newsletter_newsletters';
  $rstNewsletters = $GLOBALS['database']->database_query($strQuery);
  
  if($GLOBALS['database']->database_hasrows($rstNewsletters))
  {
     $strSelect = '<select name = "mail_newsletter" id = "mail_newsletter" class = "noblock">';
     while($arrNewsletter = $GLOBALS['database']->database_fetch($rstNewsletters))
     {
        $strSelect .= '<option value = "'.$arrNewsletter['newsletter_id'].'">'.$arrNewsletter['newsletter_title'].'</option>';  
     }
     $strSelect .= '</select>';
     $arrReplace['select_box_newsletter'] = $strSelect;
  
  }

  $strQuery = 'SELECT * FROM newsletter_lists';
  $rstLists = $GLOBALS['database']->database_query($strQuery);
  
  if($GLOBALS['database']->database_hasrows($rstLists))
  {
        $strSelect = '<select id="lists" class="multiselect" multiple="multiple" name="lists[]">';
        
        while($arrList = $GLOBALS['database']->database_fetch($rstLists))
        {
            $strSelect .= '<option value = "'.$arrList['list_id'].'">'.$arrList['list_name'].'</option>';
        }
  
        $strSelect .= '</select>';
        $arrReplace['SELECT_MAILING_LISTS'] = $strSelect;
  
  }
  
  if($GLOBALS['param']->Integer('bMail',0))
  {
      $arrMailingCampaign['mail_campaign'] = $GLOBALS['param']->String('mail_campaign','');
      $arrMailingCampaign['mail_newsletter'] = $GLOBALS['param']->Integer('mail_newsletter',0);
      $arrMailingCampaign['mail_to_address'] = $GLOBALS['param']->String('mail_to_address','');
      $arrMailingCampaign['mail_content'] = $GLOBALS['param']->String('mail_content','');
      $arrSendTo = array();
      $arrUsersToSendTo = array();
      for($i = 0; $i < count($_POST['lists']); $i++)
      {
         $arrSendTo[$i] = $_POST['lists'][$i];                   
         $strQuery = 'SELECT * FROM newsletter_users_lists where lists_list_id = ' . $arrSendTo[$i];
         $rstUsers = $GLOBALS['database']->database_query($strQuery);
         
         if($GLOBALS['database']->database_hasrows($rstUsers))
         {
             while($arrUser = $GLOBALS['database']->database_fetch($rstUsers))
             {
                $arrUsersToSendTo[$arrUser['lists_user_id']] = 1;
             }         
         }
      
      }  
      $arrMailingCampaign['mail_created'] = date('Y-m-d H:i:s', time());
      $arrMailingCampaign['mail_sendto_count'] = count($arrUsersToSendTo);
      /*First we create the mailing campaign*/
      $intID = $GLOBALS['database']->database_insert('newsletter_mailing_campaigns',$arrMailingCampaign);
      
      foreach($arrUsersToSendTo as $key=>$value)
      {
          $GLOBALS['database']->database_insert('newsletter_to_send',array('send_campaign'=>$intID,'send_user'=>$key));
      }      
      
      foreach($arrSendTo as $key => $value)
      {
          $GLOBALS['database']->database_insert('newsletter_send_lists', array('sending_list'=>$value,'sending_campaign'=>$intID)); 
      }
      
      $GLOBALS['messages']->success('Mailing Campaign Created.');
      $GLOBALS['redirect']->redirect_to('./sendmail.php');

  }




  $strQuery = 'SELECT * FROM newsletter_mailing_campaigns order by mail_created desc';
  $objPagi = new pagination();
  $arrData = $objPagi->getData($strQuery, 25, 'newsletter_campaigns');
  $arrProcessedData = array();
  foreach($arrData as $key=>$value)
  {
     $strQuery = 'SELECT * FROM newsletter_to_send where send_campaign = ' . $value['mail_id'];
     $rstCount = $GLOBALS['database']->database_query($strQuery);
     
     $intCount = $GLOBALS['database']->database_hasrows($rstCount);
     
     $value['mail_sent_total'] = $value['mail_sendto_count'] - $intCount;
     
     $strQuery = 'SELECT * FROM newsletter_send_lists LEFT JOIN newsletter_lists on sending_list = list_id  where sending_campaign = ' . $value['mail_id'];
     $rstList = $GLOBALS['database']->database_query($strQuery);
     $strList = 'No Lists or the list\'s were deleted.';
     if($GLOBALS['database']->database_hasrows($rstList))
     {
           $strList = '';
           while($arrList = $GLOBALS['database']->database_fetch($rstList))
           {
              
              if($arrList['list_name'] == '')
              {
                  $arrList['list_name'] = '[Removed List]';
              }
              $strList .= $arrList['list_name'] . ', ';
           }
           
           

     }
     $value['list_whom_is_sent']  = trim($strList,', ');
     $arrProcessedData[] = $value;
  }
  $arrReplace['LIST_OF_CAMPAIGNS']  = $objPagi->returnTemplatedData('./templates/campaign_item.html', $arrProcessedData);
  $arrReplace['pagination'] = $objPagi->getPaginationNaviBar();
  
  
  $arrReplace['form_errors'] = $GLOBALS['messages']->clearMessages();
  $sendMailTemplate->replacevars($arrReplace);
  
  $indexTemplate->replacevars(array('content'=>$sendMailTemplate->returnTemplate()));
  $indexTemplate->replacevars(array( 'ckeditor_head'=>$objWysiwig->AddHeader(),'WYSIWYG'=>$objWysiwig->addWysiwig('','mail_content','mail_content','./style.css'),'menu'=>$GLOBALS['menu']->drawMenu('send-emails')));
  echo $indexTemplate->returnTemplate();
?>