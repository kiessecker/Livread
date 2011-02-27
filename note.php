<?php

require_once("config/config.php");
# Session Management
require("includes/session-management.php");




function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",$str);
//      return $str;
    return html_entity_decode($str,null,'UTF-8');;
  }





if(isset($_GET["passage"])) {
	$str=$_GET["passage"];
	$enc=mb_detect_encoding($str);
	$str=urldecode($str);
	$str=html_entity_decode($str);
//	$str=utf8_urldecode($str);

# Correct some strange characters within
	$str=str_replace("%u2019","'",$str);


	$db = mysql_connect("localhost",$mysql_user,$mysql_pass) or die("DB error");
	mysql_select_db($mysql_db, $db);

	$query="INSERT INTO notes (notes_author, notes_bookname, notes_date, note_content, username)
		VALUES('".addslashes(html_entity_decode(urldecode($_GET["author"])))."','".addslashes(html_entity_decode(urldecode($_GET["title"])))."','".date("Y-m-d")."','".addslashes($str)."','".addslashes($_SESSION["username"])."')";
	$result = mysql_query($query);



	?>
	<script language="Javascript">
	<!--//
	parent.document.getElementById("dialogdiv").innerHTML="Passage als Notiz gespeichert.<br /><br /><button id=\"buttonTwo\" dojoType=\"dijit.form.Button\" onClick=\"dijit.byId('dialogOne').hide();\" type=\"button\">Fortfahren</button>";
	returnvar=parent.renderDojoDialog("Meldung","Aktion erfolgreich beendet",0);
	//-->
	</script>
	<?php

} else {
	echo "NoteTaking";
}
?>
