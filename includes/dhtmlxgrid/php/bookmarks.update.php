<?php
//code below is simplified - in real app you will want to have some kins session based autorization and input value checking
error_reporting(E_ALL ^ E_NOTICE);

include("../../../config/config.php");
# Session Management
require("../../../includes/session-management.php");

header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");



function add_row(){
	global $newId;
/*	
	$sql = 	"INSERT INTO notes (notes_author,notes_bookname,notes_date,note_content,username)
			VALUES ('".addslashes($_GET["c0"])."',
					'".addslashes($_GET["c1"])."',
					'".addslashes($_GET["c2"])."',
					'".addslashes($_GET["c3"])."',
					'".addslashes($_SESSION["username"])."')";
	$res = mysql_query($sql);
	//set value to use in response
	$newId = mysql_insert_id();
*/
	return "insert";	
}

function update_row(){
/*
	$sql = 	"UPDATE notes SET notes_author='".addslashes($_GET["c0"])."',
				notes_bookname=		'".addslashes($_GET["c1"])."',
				notes_date=		'".addslashes($_GET["c2"])."',
				note_content=		'".$_GET["c3"]."' 
			WHERE notes_id=".$_GET["gr_id"]." AND username='".addslashes($_SESSION["username"])."'";
	$res = mysql_query($sql);
*/	
	return "update";	
}

function delete_row(){
	$d_sql = "DELETE FROM bookmarks WHERE bookmark_id=".$_GET["gr_id"]." AND username='".addslashes($_SESSION["username"])."'";
	$resDel = mysql_query($d_sql);

	return "delete";	
}


//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may differ in your case
echo('<?xml version="1.0" encoding="utf-8"?>'); 


$mode = $_GET["!nativeeditor_status"]; //get request mode
$rowId = $_GET["gr_id"]; //id or row which was updated 
$newId = $_GET["gr_id"]; //will be used for insert operation



switch($mode){
	case "inserted":
		//row adding request
		$action = add_row();
	break;
	case "deleted":
		//row deleting request
		$action = delete_row();
	break;
	default:
		//row updating request
		$action = update_row();
	break;
}


//output update results
echo "<data>";
echo "<action type='".$action."' sid='".$rowId."' tid='".$newId."'/>";
echo "</data>";

?>
