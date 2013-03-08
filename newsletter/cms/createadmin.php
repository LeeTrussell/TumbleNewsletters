<?php
 require('application.php');
 
 $arrUser = array();
 $arrUser['user_username'] = 'HelegeSverre';
 $arrUser['user_password'] = 'Testing';
 $arrUser['user_seed'] = randomString();
 $arrUser['user_email'] = 'ltumbleweed@yahoo.co.uk';
 
 $arrUser['user_password'] = crypt($arrUser['user_password'],$arrUser['user_seed']);
 
 $GLOBALS['database']->database_insert('newsletter_login',$arrUser);
 
?>