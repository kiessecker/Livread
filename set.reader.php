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
if(isset($_GET["setreader"])) {
	$setreader=(int)$_GET["setreader"];
	if($setreader>(count($APPLICATION_READERS)-1))
		$setreader=APPLICATION_DEFAULT_READER;

	$_SESSION["current_reader"]=$setreader;

	if($_SESSION["username"]!="anonymous") { // anonymous should be untouched
		$sql="UPDATE users SET users_defaultreader=".$setreader." WHERE users_uid='".addslashes($_SESSION["username"])."'";
		$result=mysql_query($sql);
	}

	// jetzt schauen, woher gekommen (alert alle GETVARS) und ggf. Paperframe aktualisieren
	// dann read per session_include....

	$relocatingURL="index.application.php?";
	if(isset($_GET["applicationAction"])) 
		$relocatingURL.="&applicationAction=".$_GET["applicationAction"];
	if(isset($_GET["book"]))
		$relocatingURL.="&book=".$_GET["book"];

	?>
	<script language="Javascript" type="text/javascript">
	//alert("<?php echo implode($_GET);?>");
	<?php
	if($relocatingURL!="index.application.php?") {
		echo "\nparent.PAPERFRAME.location.href=\"".$relocatingURL."&updateApplicationMenu=true\";"; 
	}
	?>
	</script>
	<?php




	if(!isset($_GET["applicationAction"])) 
		require_once("index.menu.php");













}
?>
</body>
</html>
