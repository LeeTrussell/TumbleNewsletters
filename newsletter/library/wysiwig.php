<?php
    class wysiwig
    {
    
        protected $strLocation;
        function __construct($strLocation = './ckeditor/')
        {
             $this->strLocation = $strLocation;
        }
    
        function addHeader()
        {
          return '<script type = "text/javascript" src = "' . $this->strLocation . 'ckeditor.js"></script>';
        }
    
        function addWysiwig($value = '<p></p>', $name = 'editior1', $id = 'editor1', $stylesheet = 'otg_style.css')
        {
           return '<div class = "ckeditor_instance"><textarea name = "'.$name.'" id = "'.$id.'">'.$value.'</textarea>
                   	<script type="text/javascript">
				                  CKEDITOR.replace( \''.$id.'\', {
                            					extraPlugins: \'stylesheetparser\',

                              					// Stylesheet for the contents.
                              					contentsCss: \''.$stylesheet.'\',
                              
                              					// Do not load the default Styles configuration.
                              					stylesSet: [],
                              					filebrowserBrowseUrl : \'/browser/browse.php\',
                                        filebrowserUploadUrl : \'upload.php\'

                          
                          
                          } );
			             </script></div>';
        
        }
    
    }
?>
