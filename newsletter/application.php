<?php
session_start();

require('./library/database.php');
require('./library/commonfunctions.php');
require('./library/template.php');
require('./library/param.php');
require('./library/debug.php');
require('./library/messages.php');
require('./library/redirect.php');
require('./library/sign_in.php');
require('./library/menu.php');
require('./library/simpleimage.php');
require('./library/wysiwig.php');
require('./library/pagination.php');


  
  
  
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

  
  


  

  
  
  
    
?>
