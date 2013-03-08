<?php

 class pagination
 {
    
     protected $numberPerPage, $totalNumberOfRecords, $page;
    
    function getData($strQuery, $numberPerPage, $sessionName = '')
    {
      
       $intPage = $GLOBALS['param']->Integer('page',1);
       
       if(!$intPage)
       {
            if(isset($_SESSION[$sessionName]))
            {
              $intPage = $_SESSION[$sessionName];
            }
            else
            {
              $intPage = 1;
            }    
       } 
        
      $this->page = $intPage;
      
      $rstTotalRecords = $GLOBALS['database']->database_query($strQuery);
      $this->totalNumberOfRecords = mysql_num_rows($rstTotalRecords);
      $this->numberPerPage = $numberPerPage;      
      
      $intLimit = ($intPage - 1) * $numberPerPage;
      $intTopLimit = $intLimit + $numberPerPage;
      
      $rstRecords = $GLOBALS['database']->database_query($strQuery . ' LIMIT ' . $intLimit . ' , ' . $numberPerPage);
      
      /*Return an array of data*/
      $arrData = array();
      if($GLOBALS['database']->database_hasrows($rstRecords))
      {
          while($arrLine = $GLOBALS['database']->database_fetch($rstRecords))
          {
             $arrData[] = $arrLine;           
          }
      
      }
    
      /*Set a session remembering the page number*/
      $_SESSION[$sessionName] = $this->page;
    
    
    
      return $arrData;
    
    }
    
    function getPaginationNaviBar($url = 'blog_blogs.php')
    {
       /*Calculate the total number of records*/
       $floatNumberOfPages = $this->totalNumberOfRecords / $this->numberPerPage;
       $intNumberOfPages = ceil($floatNumberOfPages);
       
       /*Show only 5 pages worth at a time, two either size of the selected page*/
       $intBottom = $this->page - 5;
       $intTop = $this->page + 5;
       
       if($intBottom < 1)
       {
            $intBottom = 1;
       }
       
       if($intTop > $intNumberOfPages)
       {
            $intTop = $intNumberOfPages;       
       }
       $strContent = '<ul class = "pagination">';
       
      if($intNumberOfPages > 1)
       {
          $strContent .= '<li><a href= "?page=1"><span><<</span></a></li>';
       }
       
       
       
       for($i = $intBottom; $i <= $intTop; $i++)
       {
           $strSelected = '';
           if($i == $this->page)
           {
                $strSelected = ' class = "selected" ';
           }
           $strContent .= '<li ' . $strSelected. ' ><a  href= "?page='.$i.'"><span>'.$i.'</span></a></li>';
       
       }
      
       if($intNumberOfPages > 5)
       {
          $strContent .= '<li ' . $strSelected. ' ><a  href= "?page='.$intNumberOfPages.'"><span>>></span></a></li>';
       }
       
       $strContent .= '</ul>';
       
       return $strContent;
           
    }
    
    function returnTemplatedData($strTemplateFile, $arrData)
    {
       $strContents = '';
       foreach($arrData as $key => $arrLine)
       {
          $objTemplate = new template($strTemplateFile);
          $objTemplate->replacevars($arrLine);
          $strContents .= $objTemplate->returnTemplate();       
       
       }
    
      return $strContents;
    
    }
    
    function returnPage()
    {
       return $this->page;
    }
    
    

 }



?>
