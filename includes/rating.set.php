<?php
error_reporting(E_ALL ^ E_NOTICE);
include("../config/config.php");
# Session Management
require("../includes/session-management.php");


header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

if(!isset($_GET["book"])) exit;


$sql="SELECT book_id FROM books WHERE book_id=".addslashes($_GET["book"])." AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)<1) {
	die("Aktion nicht möglich, denn dieser User hat kein Buch mit der ID");
}


$sql="UPDATE books SET book_rating=".addslashes((int)$_GET["rating"])." WHERE book_id=".addslashes($_GET["book"]);
$res = mysql_query ($sql);
?>	

