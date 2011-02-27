<?php
error_reporting(E_ALL);
include("config/config.php");
# Session Management
require("includes/session-management.php");

# Functions
require_once("includes/functions.php");


header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr">
	<head>
		<title>Action</title>
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.css" />
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.overrides.css" />

		<link rel="stylesheet" type="text/css" href="styles/index.paper.css.php" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	</head>
	<body class="claro">


<?php
if(!isset($_GET["book"])) die("Was willst Du bookmarken?");


$sql="SELECT * FROM books WHERE book_id=".(int)$_GET["book"]." AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)==0) {
	die("Du versuchst ein Bookmark für ein Buch zu setzen, daß Du nicht (mehr?) besitzt!");
}

// round to seven digits below decimum
// probably better would be to check the size of the book and for small to medium books have 5 digits (that correlates with ca. 9000 Pages??? and for bigger books with 6 or 7 digits below decimum
$_GET["page"]=round($_GET["page"],5);
$bookmarkName=date("d.m.Y H:i");
if($_SESSION["current_reader"]==2)
$bookmarkName.=" Seite: ".$_GET["page"];

# Add/Remove-Bookmark 
$sql="SELECT book_id FROM bookmarks WHERE book_id=".$_GET["book"]." AND username='".addslashes($_SESSION["username"])."' AND page_number=".$_GET["page"]." AND component='".addslashes($_GET["component"])."' AND reader=".$_SESSION["current_reader"]." LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0) {

	// delete
	$sql="DELETE FROM bookmarks WHERE book_id=".$_GET["book"]." AND  username='".addslashes($_SESSION["username"])."' AND page_number=".$_GET["page"]." AND component='".addslashes($_GET["component"])."' AND reader=".$_SESSION["current_reader"];
	$result=mysql_query($sql);
	$messageTitle="Lesezeichen entfernt.";
	$message="Das für diese Seite gesetzte Lesezeichen wurde entfernt!";

} else {
	$sql="INSERT INTO bookmarks (book_id, page_number, bookmark_date, username, reader, component, bookmark_name) VALUES (
	".$_GET["book"].",
	".$_GET["page"].",
	'".date("Y-m-d")."',
	'".addslashes($_SESSION["username"])."',".$_SESSION["current_reader"].",'".addslashes($_GET["component"])."','".addslashes($bookmarkName)."')";
	$result=mysql_query($sql);
	$messageTitle="Lesezeichen hinzugef&uuml;gt.";
	$message="Für diese Seite wurde ein Lesezeichen gesetzt!";
}
?>

<script type="text/javascript">
parent.renderSimpleDialog("Lesezeichenmanager","<?php echo addslashes($messageTitle);?>","<?php echo addslashes($message);?>");
</script>

<?php
# We update the menu, its possible from this position!
require_once("index.menu.php");
?>




</body>
</html>
