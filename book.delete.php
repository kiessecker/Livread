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
if(!isset($_GET["book"])) die("Was willst Du löschen?");


$sql="SELECT * FROM books WHERE book_id=".addslashes($_GET["book"])." AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)==1) {
	$row=mysql_fetch_assoc($result);
	$book_dir=REPOSITORY_BASE_DIR."/".addslashes($_SESSION["username"])."/".$row["book_author"]."/".$row["book_title"];
	$book_dir_cmd="rm -rf \"".$book_dir."\"";
	if(is_dir($book_dir)) {
		exec($book_dir_cmd); 

		$sql="DELETE FROM bookmarks WHERE book_id=".addslashes($_GET["book"]);
		$result=mysql_query($sql);



		$sql="DELETE FROM currposition WHERE book_id=".(int)$_GET["book"]." AND username='".addslashes($_SESSION["username"])."'";
		$result=mysql_query($sql);




		$sql="DELETE FROM contents WHERE book_id=".addslashes($_GET["book"]);
		$result=mysql_query($sql);
		livreadSynchronize();

		if(isset($_GET["backto"]))
			$backto=$_GET["backto"];
		else
			$backto="welcome";

		?>
		<script language="Javascript" type="text/javascript">

		var resetReadingSetting=false;



		if(parent.currentBookId==<?php echo $_GET["book"];?>) {
			// Actual reading book will be deletet, so we urgently need to reset 
			// entire reading process and menu
			resetReadingSetting=true;
		}

		// check if user had previously bookmarks of the currently deleted book, if so, we need to 
		// reset reading process, and reset menu, too
		for(i=0;i<parent.currentUsersBookmarks.length;i++) {
			if(parent.currentUsersBookmarks[i]=="<?php echo $_GET["book"];?>") {
				resetReadingSetting=true;
			}

		}



		if(resetReadingSetting==true) {
			parent.currentBookId=null;
			parent.currentBookPage=null;
			parent.currentBookAuthor=null;
			parent.currentBookTitle=null;
			parent.currentUsersBookmarks=new Array();

			parent.document.getElementById("MyLeftPaneReadingNav").innerHTML="";
			parent.document.getElementById("MyLeftPaneInfoAuthor").innerHTML="";
			parent.document.getElementById("MyLeftPaneInfoTitle").innerHTML="";
			parent.document.getElementById("MyLeftPaneInfoPages").innerHTML="";
			parent.document.getElementById("MyLeftPaneInfoRating").innerHTML="";
		}








		/* todo: (letzter Stand, wichtig)
		if(resetReadingSettings!=true)
			checken, ob aktuell im Menü unter Lesezeichen ein Eintrag mit dem zu löschenden Buch,
			dann ganz gezielt diesen Eintrag löschen; ansonsten müßte das ganze Menü neu aufgebaut werden
			Und auch checken, ob letztes Lesezeichen das gelöschte Buch betrifft; ....

			Laufen durch parent.currentUsersBookmarks, ob gelöschtes Buch dabei, wenn ja, resetReadingSettings auf true setzen

		*/


		parent.renderSimpleDialog("Buchmanagement","Löschung erfolgreich","Das Buch wurde aus Ihrer Bibliothek entfernt.");

		if(resetReadingSetting==true) {

			parent.PAPERFRAME.location.href="index.application.php?applicationAction=<?php echo $backto;?>&updateApplicationMenu=true"; 
		} else {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=<?php echo $backto;?>"; 
		}


		</script> <?php
	} else { ?>
		<script language="Javascript" type="text/javascript">
		parent.renderSimpleDialog("Buchmanagement","Löschung misslungen","Das Buch konnte nicht aus Ihrer Bibliothek entfernt werden, da Sie nicht die nötigen Berechtigungen dazu haben.<?php echo $book_dir_cmd;?>");
		parent.PAPERFRAME.location.href="index.application.php?applicationAction=welcome&updateApplicationMenu=true"; 
		</script><?php
	}
} else { ?>
	<script language="Javascript" type="text/javascript">
	parent.renderSimpleDialog("Buchmanagement","Löschung misslungen","Sie haben kein solches Buch (Kein Buch mit dieser Nummer).");
	parent.PAPERFRAME.location.href="index.application.php?applicationAction=welcome&updateApplicationMenu=true"; 
	</script>
<?php } ?>

</body>
</html>
