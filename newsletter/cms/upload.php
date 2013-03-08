<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
require('application.php');
// Define a destination
$folderPath = '/newsletter/';
$targetFolder = './ckeditor_images/'; // Relative to the root
$funcNum = $_GET['CKEditorFuncNum'];

          if (!empty($_FILES)) {
      	$tempFile = $_FILES['upload']['tmp_name'];
      	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
      	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['upload']['name'];
      	
      	// Validate the file type
      	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
      	$fileParts = pathinfo($_FILES['upload']['name']);
      	
      	if (in_array($fileParts['extension'],$fileTypes)) {
      		//move_uploaded_file($tempFile,$targetFile);
      		//echo '1';
      		$image = new SimpleImage();
          $image->load($_FILES['upload']['tmp_name']);
      		$strFilnameWithoutExtension = uniqid('image_');
      		$strFilenameWithExtension = $strFilnameWithoutExtension . '.' . $fileParts['extension'];
      		$image->save($targetFolder .  $strFilenameWithExtension, $image->image_type);
           echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '".dirname($_SERVER['PHP_SELF']).''.$targetFolder.$strFilenameWithExtension."', 'Image Uploaded.')</script>";
;
      		

      		
      		
      	} else {
      		echo '0';
      		exit();
      	}
      }
      



else
{
   echo '0';
   exit();
}




?>