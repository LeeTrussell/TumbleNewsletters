<?php

    class filter
    {
           protected $filter, $genre, $subgroup;
    
            function __construct($strSessionName)
            {
               if(isset($_SESSION[$strSessionName]))
               {
                    $this->filter = $_SESSION[$strSessionName]['filter'];
                    $this->genre = $_SESSION[$strSessionName]['genre'];
                    $this->subgroup = $_SESSION[$strSessionName]['group'];
                    $this->mostpopular = $_SESSION[$strSessionName]['mostpopular'];
                    
               }           
            
            }
            
            function drawPanel($link,$genre='')
            {
                $strContent = '<ul class="browse-results-filters">';
                
                    $letter = 'a';
                    
                    for($i = 1; $i <= 26; $i++)
                    {
                        $strClass = '';
                        if($letter == $this->filter)
                        {
                            $strClass = 'class = "selected"';
                        }

                        $strGenre = '';
                        
                        if(strlen($genre))
                        {
                           $strGenre = '?genre='.$genre;
                        }

                        $strContent .= '<li '.$strClass.'><a href = "'.$link.'/filter/'.$letter.$strGenre.'"><span>'.$letter.'</span></a></li>';
                        $letter++;
                    }
                    
                    $strClass = '';
                    if($this->filter == 'all')
                    {
                       $strClass = 'class = "selected"';
                    }
                    
                         $strGenre = '';
                        
                        if(strlen($genre))
                        {
                           $strGenre = '?genre='.$genre;
                        }
                    
                    
                    $strContent .= '<li '.$strClass.'><a class="all" href = "'.$link.'/filter/all'.$strGenre.'"><span>All</span></a></li>';

                $strContent .= '</ul>';
            
                return $strContent;
            
            }
            
            function getFilter()
            {
                  return $this->filter;
            }
            
            function getGenre()
            {
                  return $this->genre;
            }
            
            function getSubGroup()
            {
                return $this->subgroup;    
            }
            
            function getMostPopular()
            {
              return $this->mostpopular;
            }
            
            function drawSelectBox($arrOptions, $strName)
            {
               $strContent = '<div class="filter-select-box"><form action = "" id = "frm_filter_select" method = "get" name = "frm_filter_select" ><select onchange = "browseGenre();" id = "'.$strName.'" name = "'.$strName.'"><option value = "">View All</option>';
               
                   foreach($arrOptions as $key=>$value)
                   {
                       $strSelected = '';
                       
                       if($this->genre == $value)
                       {
                          $strSelected = ' selected = "selected" ';
                       }
                       
                       $strContent .= '<option '.$strSelected.' value = "'.$value.'">'.$value.'</option>';
                   }

               $strContent .= '</select></form></div>';
               return $strContent;         
            }
            
            function drawPlaythroughsFilter($strLink = '')
            {
               $arrOptions = array('all'=>'All Playthroughs','most-recent'=>'Most Recent Playthroughs','most-popular'=>'Most Popular Playthroughs',);
               $strContent = '<ul class="browse-results-filters">';
               
                  foreach($arrOptions as $key => $value)
                  {
                    $strSelected = '';
                    if(str_replace('-','',$key) == $this->getSubGroup())
                    {
                       $strSelected = ' class = "selected" ';
                    
                    }
                    
                    
                    $strContent .= '<li'.$strSelected.'><a class = "filter-group" href = "'.$strLink.'/'.$key.'"><span>'.$value.'</span></a></li>';
                  
                  }
               
               $strContent .= '</ul>';
                return $strContent;
            
            }
            
            function drawMostPopular($strLink = '')
            {
                 $arrOptions = array('most-popular-of-all-time'=>'All Time','most-popular-this-week'=>'This Week','most-popular-this-month'=>'This Month','most-popular-this-year'=>'This Year');
                  $strContent = '<ul class="browse-results-filters">';
               
                  foreach($arrOptions as $key => $value)
                  {
                    $strSelected = '';
                    if($key == $this->getMostPopular())
                    {
                       $strSelected = ' class = "selected" ';
                    
                    }
                    
                    
                    $strContent .= '<li'.$strSelected.'><a class = "filter-popular" href = "'.$strLink.'/'.$key.'"><span>'.$value.'</span></a></li>';
                  
                  }
               
               $strContent .= '</ul>';
                return $strContent;
            
            
            
            
            }
            
           
            
            
        
    }


?>
