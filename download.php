<?php 
include 'session.php';
$home = $_SESSION['homefolder'];
$file = $_GET["file"]; 
$source = $home . $file;
if(isset($file) && file_exists($source)){
      switch(strtolower(substr(strrchr(basename($source),"."),1))){
         case "pdf": $type="application/pdf"; break;
         case "exe": $type="application/octet-stream"; break;
         case "zip": $type="application/zip"; break;
         case "doc": $type="application/msword"; break;
         case "xls": $type="application/vnd.ms-excel"; break;
         case "ppt": $type="application/vnd.ms-powerpoint"; break;
         case "gif": $type="image/gif"; break;
         case "png": $type="image/png"; break;
         case "jpg": $type="image/jpg"; break;
         case "mp3": $type="audio/mpeg"; break;
         case "php": 
         case "htm": 
         case "html": 
      }
      header("Content-Type: ".$type); 
      header("Content-Length: ".filesize($source)); 
      header("Content-Disposition: attachment; filename=".basename($source)); 
      readfile($source); 
      exit;   
}
?>