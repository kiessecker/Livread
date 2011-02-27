<?php

# Browser Patching
require("includes/browserpatch.php");

# Basic settings
require_once("includes/error-reporting.php");
require_once("includes/http-header.php");

# Get configuration loaded
require_once("config/config.php");

# Session Management
require("includes/session-management.php");

# Personal Modifications
require_once("includes/personal-modifications.php");

# Guarding that no one deletes others possessions
require_once("includes/attack-guarding.php");

# Functions
require_once("includes/functions.php");




header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");



# Application Locals
$applicationAction="welcome";
if(isset($_GET["applicationAction"])) $applicationAction=$_GET["applicationAction"];
if(isset($_POST["applicationAction"])) $applicationAction=$_POST["applicationAction"];

# ExpandoRememberance Work
$applicationExpandoCookie=$applicationAction;
if($applicationExpandoCookie=="read")
	$applicationExpandoCookie="read_".$_SESSION["current_reader"];



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr">
	<head>
		<title>Action</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.css" />
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.overrides.<?php echo $_SESSION["cssstyle"];?>.css" />
		<link rel="stylesheet" type="text/css" href="styles/index.paper.css.php" />
		<script src="index.paper.js" type="text/javascript"></script>
		<script type="text/javascript">
		parent.changeActiveStyleSheet("<?php echo $_SESSION["cssstyle"];?>");
		parent.appCurrentActivity=0;
		parent.appCurrentActivity="<?php echo addslashes($applicationExpandoCookie);?>";
		<?php
		// This is for ExpandoPane-Toggle-Memory
		if(!isset($_COOKIE["expandoframe_".addslashes($applicationExpandoCookie)."_activelyClosed"])) { ?>	
			if(parent.dijit.byId("paneInfodock")._showing==false) parent.dijit.byId("paneInfodock").toggle(); <?php 
		} else {
			if($_COOKIE["expandoframe_".addslashes($applicationExpandoCookie)."_activelyClosed"]==1) { ?>	
				if(parent.dijit.byId("paneInfodock")._showing==true) parent.dijit.byId("paneInfodock").toggle(); <?php 
			} else { ?>	
				if(parent.dijit.byId("paneInfodock")._showing==false) parent.dijit.byId("paneInfodock").toggle(); <?php	
			}
		} 	
		?>
		</script>
	</head>
	<body class="claro"<?php if($applicationAction=="read") echo " ondblclick=\"parent.translateSelection()\"";?>>

<?php


# Application Menu // show only when neccessary
if( (count($_GET)==0 && count($_POST)==0) || 
	isset($_GET["updateApplicationMenu"]) ||
	isset($_POST["updateApplicationMenu"])  ) 
	require_once("index.menu.php");




require("includes/".$applicationAction.".php");

// print_r($_SESSION["may_read"]);


?>
	<script type="text/javascript">
	if (parent.appProtection!=true) {
		top.location.href="http://<?php echo $_SERVER["SERVER_NAME"];?>/index.php";
	}
	</script>
	</body>
</html>
