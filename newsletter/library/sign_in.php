<?php
    class sign_in
    {
       protected $strTablename, $strUsernameField, $strPasswordField, $sessionName, $loggedIn, $strSeedField;
       
       function __construct($strTablename, $strUsernameField, $strPasswordField, $sessionName, $strSeedField = 'user_seed')
       {
            $this->sessionName = $sessionName;
            $this->strTablename = $strTablename;
            $this->strUsernameField = $strUsernameField;
            $this->strPasswordField = $strPasswordField;
            $this->strSeedField = $strSeedField;
            
            /*First we check if the user is logged in or not*/
            if(isset($_SESSION[$sessionName]['username']) && isset($_SESSION[$sessionName]['password']))
            {
                 $strUsername = htmlspecialchars($_SESSION[$sessionName]['username'],ENT_QUOTES);
                 $strPassword = htmlspecialchars($_SESSION[$sessionName]['password'],ENT_QUOTES);
            
                  $strQuery = 'SELECT * FROM ' . $strTablename . ' WHERE ' . $strUsernameField . " = '" . $strUsername . "'";
                  $rstUser = $GLOBALS['database']->database_query($strQuery);
                  if($GLOBALS['database']->database_hasrows($rstUser))
                  {
                    $arrUser = $GLOBALS['database']->database_fetch($rstUser);
                     
                     
                      if($arrUser[$strPasswordField] == $strPassword)
                      {
                        unset($arrUser[$strSeedField]);
                        $_SESSION[$this->sessionName]['extras'] =$arrUser;
                        $this->loggedIn = true;
                        return true;
                      }
                      else
                      {
                       $this->loggedIn = false;
                       return false;
                      }
                  }
                  else
                  {
                     return false;
                  }
 
            }
            else
            {
               $this->loggedIn = false;
               return false;
            }
        }
       
            function isLoggedIn()
            {
              return $this->loggedIn;
            }
       
            function login($strUsername, $strPassword)
            {
                $_SESSION[$this->sessionName] = array('username'=>$strUsername,'password'=>$strPassword);               
                $strQuery = 'SELECT * FROM ' . $this->strTablename . ' WHERE ' . $this->strUsernameField . " = '" . $strUsername . "' AND " . $this->strPasswordField . " = '" . $strPassword . "'";
                $rstUser = $GLOBALS['database']->database_query($strQuery);
                if($GLOBALS['database']->database_hasrows($rstUser))
                {
                  $arrUser = $GLOBALS['database']->database_fetch($rstUser);
                  unset($arrUser[$this->strSeedField]);
                  $_SESSION[$this->sessionName]['extras'] = $arrUser; 
                
                }
                $this->loggedIn = true;
            
            }
       
            function checkLogin($strRedirect='./tumble_login.php', $arrPriv = array(1), $priv_field = 'user_privileges')
            {
                if($this->loggedIn == false || !in_array($_SESSION[$this->sessionName]['extras'][$priv_field],$arrPriv))
                {
                    header('Location: ' . $strRedirect);
                    exit();
                
                }
            
            }
       
            function logout($strRedirect = './tumble_login.php')
            {
                unset($_SESSION[$this->sessionName]);
                header('Location: '.$strRedirect);
                exit();
                
            }
            
            function getExtra($strName = '')
            {
                if(isset($_SESSION[$this->sessionName]['extras'][$strName]))
                {
                
                      return $_SESSION[$this->sessionName]['extras'][$strName];
               }
               else
               {
                      return null;
               }
            }
            
            
       
    
    
    
    
    
    }
?>
