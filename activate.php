<?php

# Get configuration loaded
require_once("config/config.php");

if(!isset($_GET["activationId"]))
	die("Wrong URL");


$query="SELECT * FROM users WHERE users_uuid='".addslashes($_GET["activationId"])."' AND users_valid=1 LIMIT 0,1";
$result=mysql_query($query);
if(mysql_num_rows($result)>0)
	die("Ihr Zugang wurde bereits aktiviert!");


$query="SELECT * FROM users WHERE users_uuid='".addslashes($_GET["activationId"])."' AND users_valid=0 LIMIT 0,2";
$result=mysql_query($query);
if(mysql_num_rows($result)>1)
	die("Es ist ein Fehler aufgetreten."); 	


if(mysql_num_rows($result)==1) {
	$row=mysql_fetch_assoc($result);
	$query="UPDATE users SET users_valid=1 WHERE users_uuid='".addslashes($_GET["activationId"])."' AND users_valid=0";
	$result=mysql_query($query);

	setcookie("livreadActivated", "true",time()+3600);
	header("Location: index.php");
	exit;
} 	


?>


