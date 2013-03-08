<?php

    class menu
    {
         protected $arrMenuItems, $strSelectedClass, $strULname;
         
         function __construct($strSelectedClass = '', $strULname = '')
         {
            $this->strSelectedClass = $strSelectedClass;
            $this->strULname = $strULname;
         }
         
         
         function addMenuItem($menuName, $menuLink, $menuText = '', $arrPriv = array(1), $intPriv = 1)
         {
            if(in_array($intPriv,$arrPriv))
            {
                 $this->arrMenuItems[] = array('name'=>$menuName,'link'=>$menuLink,'text'=>$menuText);         
            }
         }
         
         function drawMenu($strSelected = '')
         {
              $strContent = '<ul class = "'.$this->strULname.'">';
              foreach($this->arrMenuItems as $key => $value)
              {
                 
                 $strSel = '';
                 if($strSelected == $value['name'])
                 {
                    $strSel = ' class = "'.$this->strSelectedClass.'" ';
                 }
                 if(strlen($value['text']))
                 {
                     $strTitle = $value['text'];
                 }
                 else
                 {
                     $strTitle = $value['name'];
                 }
                 
                 $strContent .= '<li'.$strSel.'><a href="'.$value['link'].'"><span class = "valign">'.$strTitle.'</span></a></li>';
              
              }
         
              $strContent .= '</ul>';
              
              return $strContent;
         }
    
    
    }






?>
