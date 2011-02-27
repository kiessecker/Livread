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
$sql="SELECT bookmarks.bookmark_id, bookmarks.page_number, bookmarks.bookmark_date,books.book_id,books.book_author,books.book_title FROM bookmarks,books WHERE bookmarks.username='".addslashes($_SESSION["username"])."' AND bookmarks.book_id=books.book_id ORDER BY books.book_author ASC, page_number DESC, bookmark_date DESC";
$res = mysql_query ($sql);
	


	
if($res){
	while($row=mysql_fetch_array($res)){
		//create xml tag for grid's row
		echo ("<row id='".$row['bookmark_id']."'>");
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['book_id']))."]]></cell>");
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['book_author']))."]]></cell>");
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['book_title'])."]]></cell>"));
		print("<cell><![CDATA[".gmdate("m/d/Y",strtotime($row['bookmark_date']))."]]></cell>");
		print("<cell><![CDATA[".utf8_encode(stripslashes($row['page_number']))."]]></cell>");
		print("</row>");
	}
}else{
//error occurs
	echo mysql_errno().": ".mysql_error()." at ".__LINE__." line in ".__FILE__." file<br>";
}

echo '</rows>';

?>
