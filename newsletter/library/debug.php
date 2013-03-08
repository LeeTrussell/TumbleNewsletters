<?php
      class debug
      {
          function __construct()
          {
              
          }
          
          function addToDebug($message)
          {
              $_SESSION['debug'] .= '<li>' . $message . '</li>';
          }
          
          function displayDebug()
          {
            echo '<ul>' . $_SESSION['debug'] . '</ul>';
            unset($_SESSION['debug']);
          }
      
      }
?>
