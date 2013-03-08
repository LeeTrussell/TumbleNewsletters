<?php
  
  ini_set("max_execution_time", "300");
  require('application.php');
  require_once('./class.phpmailer.php');
  
  $strQuery = 'SELECT * FROM newsletter_settings where settings_id = 1';
  $rstSettings = $GLOBALS['database']->database_query($strQuery);
  $arrSettings = $GLOBALS['database']->database_fetch($rstSettings);
  
  
  $strQuery = 'SELECT * FROM newsletter_to_send LEFT JOIN newsletter_subscribers ON send_user = subscribe_id LEFT JOIN newsletter_mailing_campaigns ON send_campaign = mail_id LEFT JOIN newsletter_newsletters ON mail_newsletter = newsletter_id LIMIT 3';
  $rstUserNewsletter = $GLOBALS['database']->database_query($strQuery);
  
  if($GLOBALS['database']->database_hasrows($rstUserNewsletter))
  {
     while($arrSend = $GLOBALS['database']->database_fetch($rstUserNewsletter))
     {
     
     
$mail             = new PHPMailer();
$body = htmlspecialchars_decode($arrSend['newsletter_content']);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $arrSettings['smtp_host']; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = htmlspecialchars_decode($arrSettings['smtp_host']); // sets the SMTP server
$mail->Port       = $arrSettings['smtp_port'];                    // set the SMTP port for the GMAIL server
$mail->Username   = $arrSettings['smtp_username']; // SMTP account username
$mail->Password   = htmlspecialchars_decode($arrSettings['smtp_password']);        // SMTP account password

$mail->SetFrom($arrSettings['smtp_username'], $arrSettings['smtp_from']);

$mail->AddReplyTo($arrSettings['smtp_username'], $arrSettings['smtp_from']);

$mail->Subject    = $arrSend['mail_campaign'];

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$current_folder = dirname($_SERVER['PHP_SELF']);
$mail->MsgHTML('<html><head><base href = "http://'.$_SERVER['HTTP_HOST'].''.$current_folder.'" /><link rel="stylesheet" type="text/css" href="./style.css"></head><body>'.$body.'<div class = "unsubscribe"><a href = "./'.$current_folder.'/../unsubscribe.php?email='.$arrSend['subscribe_email'].'">Please click this link to unsubscribe</a></div></body></html>');

$address = $arrSend['subscribe_email'];
$mail->AddAddress($address, $arrSend['mail_to_address']);

$mail->Send();
$GLOBALS['database']->database_delete('newsletter_to_send','send_id='.$arrSend['send_id']);
sleep(10);


      }
}
?>
