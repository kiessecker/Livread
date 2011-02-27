<?php 

header("Expires: 0"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("cache-control: no-store, no-cache, must-revalidate"); 
header("Pragma: no-cache");

$filename = "/tmp/".$_GET["filename"];

header('Content-type: audio/mpeg');

// It will be called downloaded.pdf

readfile($filename);

?>
