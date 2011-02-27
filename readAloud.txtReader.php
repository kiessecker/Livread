<?php

ob_end_flush();

# Basic settings
require_once("includes/http_post_stream.php");
require_once("includes/error-reporting.php");
require_once("includes/http-header.php");

# Get configuration loaded
require_once("config/config.php");

# Session Management
require("includes/session-management.php");

# Functions
require_once("includes/functions.php");

header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");


// Actions considered within read.php
if(!isset($_GET["action"]))
	$_GET["action"]="";







switch($_GET["action"]) {
	case "stop":
		$_SESSION["voice_active"]=0;
		if($_SESSION["username"]!="anonymous") {
			$qryStr="UPDATE users SET users_voice_active=0 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			$result=mysql_query($qryStr);
		}
	break;
	case "start":
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$qryStr="UPDATE users SET users_voice_active=1 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			$result=mysql_query($qryStr);
		}
	break;
	case "voice0":
		$_SESSION["current_voice"]=0;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=0 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice1":
		$_SESSION["current_voice"]=1;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=1 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice2":
		$_SESSION["current_voice"]=2;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=2 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice3":
		$_SESSION["current_voice"]=3;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=3 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice4":
		$_SESSION["current_voice"]=4;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=4 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice5":
		$_SESSION["current_voice"]=5;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=5 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice6":
		$_SESSION["current_voice"]=6;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=6 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice7":
		$_SESSION["current_voice"]=7;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=7 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice8":
		$_SESSION["current_voice"]=8;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=8 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice9":
		$_SESSION["current_voice"]=9;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=9 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice10":
		$_SESSION["current_voice"]=10;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=10 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice11":
		$_SESSION["current_voice"]=11;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=11 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voice14":
		$_SESSION["current_voice"]=14;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=14 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;

	# Special Voices are with values of 90+

	case "voiceKatrin":
		$_SESSION["current_voice"]=90;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=90 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;
	case "voiceAllison":
		$_SESSION["current_voice"]=91;
		$_SESSION["voice_active"]=1;
		if($_SESSION["username"]!="anonymous") {
			$sql="UPDATE users SET users_voice_active=1, users_voice_config_id=91 WHERE users_uid='".addslashes($_SESSION["username"])."'";
			mysql_query($sql);
		}
	break;




}



?>
<html>
	<head>
		<title><?php echo UNIQUEAPPNAME;?> Buch lesen</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<script src="readAloud.txtReader.js" type="text/javascript"></script>
	</head>
	<body>
<?php

	if($_SESSION["voice_active"]==0 || $_SESSION["may_read"]!=1) {
		?>

		<!-- dewplayer -->
		<object type="application/x-shockwave-flash" data="dewplayer/dewplayer-mini.swf" width="160" height="20" id="dewplayer" name="dewplayer">
		<param name="wmode" value="transparent" />
		<param name="movie" value="dewplayer/dewplayer-mini.swf" />
		<param name="flashvars" value="mp3=/sounds/stop.mp3&amp;autostart=1&amp;nopointer=1" />
		</object>
		</body></html>
		<?php
		exit;
	} 



	if(isset($_GET["rand"]))
		echo "<"."!-- ".$_GET["rand"]."--".">";

	$buffer="";
	$sql="SELECT * FROM users WHERE users_uid='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$contents=$row["users_curr_voice_reading_paragraph"];

	echo "POST TO speaker.livread.com and retrieve contents to get output";


?>
</body>
</html>
