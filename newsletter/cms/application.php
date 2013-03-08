<?php
session_start();

require('../library/database.php');
require('../library/commonfunctions.php');
require('../library/template.php');
require('../library/param.php');
require('../library/debug.php');
require('../library/messages.php');
require('../library/redirect.php');
require('../library/sign_in.php');
require('../library/menu.php');
require('../library/simpleimage.php');
require('../library/wysiwig.php');
require('../library/pagination.php');

    $folderPath = '/blog/';
  

  $mysql_host = "localhost";
  $mysql_database = "newsletter";
  $mysql_user = "root";
  $mysql_password = "";




  $GLOBALS['debug'] = new debug;
  $GLOBALS['database'] = new database;
  $GLOBALS['database']->database_connect("$mysql_host", $mysql_database, $mysql_user, $mysql_password);
  
  $GLOBALS['param'] = new param;
  $GLOBALS['messages'] = new messages;
  $GLOBALS['redirect'] = new redirect;
  $GLOBALS['login'] = new sign_in('newsletter_login','user_username','user_password','newsletter_login_session');

  if($GLOBALS['param']->Integer('signout',0))
  {
      $GLOBALS['login']->logout('./index.php');
  
  }



  $GLOBALS['menu'] = new menu('selected','cms-navigation');
  $indexTemplate = new template('./templates/index.html');
  if($GLOBALS['login']->isLoggedIn())
  {
     $GLOBALS['menu']->addMenuItem('mailing-list','./mailing_list.php','Mailing Lists');
     $GLOBALS['menu']->addMenuItem('html-emails','./newsletters.php','Templates');
     $GLOBALS['menu']->addMenuItem('send-emails','./sendmail.php','Send Mail');
     $GLOBALS['menu']->addMenuItem('subscribers','./users.php', 'Subscribers');
     $GLOBALS['menu']->addMenuItem('Settings','./settings.php','Settings');
     $GLOBALS['menu']->addMenuItem('Sign-Out','?signout=1','Sign Out'); 
  }
  
  
  
  
  

  
  
  
    
?>
