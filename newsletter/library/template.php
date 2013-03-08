<?php
       class template
       {
            protected $template, $handle, $temp;
            
            function __construct($file)
            {
                $this->handle = fopen($file,'r');
                $this->template = fread($this->handle,filesize($file));
                $this->temp = $this->template;
                fclose($this->handle);
            }
       
            function replacevars($arrSubstitutes)
            {
                /*We need to replace all the variables*/
                foreach($arrSubstitutes as $var=>$value)
                {
                   $this->template = str_replace('<!--['.strtoupper($var).']-->',$value,$this->template);
                }
            
            }
            
            function returnTemplate()
            {
                return $this->template;
            }
            
            function displayTemplate()
            {
                echo $this->template;
            
            }
       
       }
?>
