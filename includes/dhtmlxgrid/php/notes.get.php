<?php
error_reporting(E_ALL ^ E_NOTICE);
include("../../../config/config.php");
# Session Management
require("../../../includes/session-management.php");


header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");


//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may be different in your case
echo('<?xml version="1.0" encoding="utf-8"?>'); 

//start output of data
echo '<rows id="0">';

//output data from DB as XML
$sql = "SELECT * FROM notes WHERE username='".addslashes($_SESSION["username"])."' ORDER BY notes_id DESC";
$res = mysql_query ($sql);
	
	
if($res){
	while($row=mysql_fetch_array($res)){
		//create xml tag for grid's row
		echo ("<row id='".$row['notes_id']."'>");
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['notes_author']))."]]></cell>");
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['notes_bookname']))."]]></cell>");
		print("<cell><![CDATA[".$row['notes_date']."]]></cell>");
echo "\n";
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['note_content']))."]]></cell>");
//		print("<cell><![CDATA[".$row['price']."]]></cell>");
//		print("<cell><![CDATA[".$row['instore']."]]></cell>");
//		print("<cell><![CDATA[".$row['shipping']."]]></cell>");
//		print("<cell><![CDATA[".$row['bestseller']."]]></cell>");
//		print("<cell><![CDATA[".gmdate("m/d/Y",strtotime($row['pub_date']))."]]></cell>");
		print("</row>");
	}
}else{
//error occurs
	echo mysql_errno().": ".mysql_error()." at ".__LINE__." line in ".__FILE__." file<br>";
}

echo '</rows>';

?>
