<?php

if(!isset($_GET["word"])) {
	exit;
} else

$searchPhraseForDB=trim($_GET["word"]);

require_once("config/config.php");
# Session Management
require("includes/session-management.php");

header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");




function modifyTerm($term) {

	if(substr($term,strlen($term)-3,3)=="ing") {
		$term=substr($term,0,strlen($term)-3);
		return $term;
	}


	if(substr($term,strlen($term)-4,4)=="bbed") {
		$term=substr($term,0,strlen($term)-3);
		return $term;
	}


	if(substr($term,strlen($term)-3,3)=="ied") {
		$term=substr($term,0,strlen($term)-4);
		return $term;
	}

	if(strlen($term)>5) {
		if(substr($term,strlen($term)-2,2)=="ed") {
			$term=substr($term,0,strlen($term)-2);
			return $term;
		}
	} else {
		if(substr($term,strlen($term)-2,2)=="ed") {
			$term=substr($term,0,strlen($term)-1);
			return $term;
		}
	}

	if(substr($term,strlen($term)-2,2)=="es") {
		$term=substr($term,0,strlen($term)-2);
		return $term;
	}


	if(substr($term,strlen($term)-1,1)=="s") {
		$term=substr($term,0,strlen($term)-1);
		return $term;
	}


	return $term;
}





$db = mysql_connect("localhost",$mysql_user,$mysql_pass) or die("DB error");
mysql_select_db($mysql_db_trans, $db);


$_GET["word"]=trim($_GET["word"]);

$output="";


$query="SELECT ed_value FROM ed WHERE ed_key='".addslashes(trim($_GET["word"]))."' LIMIT 0,1";
$result = mysql_query($query);
# Append the first identical
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $output.=$row[0]; 
}
# We now modify the selected term to find more words
$_GET["word"]=modifyTerm($_GET["word"]);
//	echo $_GET["word"];
//	echo "\n\n";

$query="SELECT ed_value FROM ed WHERE ed_key LIKE '".addslashes(trim($_GET["word"]))."%' LIMIT 0,10";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $output.=$row[0];  
}

# Charset modifications
$html=iconv("ISO-8859-1", "UTF-8", $output);


if(strlen(trim($output))>0) {
	# Wordtraining 
	mysql_select_db($mysql_db, $db);
	$qryStr="SELECT * FROM translations WHERE translation_phrase='".addslashes($searchPhraseForDB)."' AND translation_username='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($qryStr);
	if(mysql_num_rows==0) {
		$qryStr="INSERT INTO translations (translation_phrase, translation_translation, translation_username, 
			translation_date) VALUES (
			'".addslashes($searchPhraseForDB)."','".addslashes(utf8_decode($html))."','".addslashes($_SESSION["username"])."','".date("Y-m-d")."')";
		$result=mysql_query($qryStr);
	}
}



?>
<html>
	<head>
<script language="Javascript">
<!--
<?php
$html=ereg_replace("\<div height\=\"2\"\>","<div>",$html);
$html=ereg_replace("\<img hspace=\"[0]+\" align=\"[a-z]+\" lorecindex=\"[0-9]+\" recindex=\"[0-9]+\" hirecindex=\"[0-9]+\"/>","",$html);
$html=ereg_replace("\height=\"[0-9]+\"","",$html);
$html=ereg_replace("\<small\>","",$html);
$html=ereg_replace("\<\/small\>","",$html);
$html=ereg_replace("\<blockquote\>","",$html);
$html=ereg_replace("\<\/blockquote\>","",$html);



?>
<?php if(strlen(trim($output))>0) { ?>

parent.document.getElementById("dialogdiv").innerHTML="<?php echo addslashes($html); ?>";
parent.renderDojoTranslationDialog();

<?php } else {
?>

parent.renderSimpleDialog("Wörterbuch","Kein Eintrag gefunden","Es konnte kein Eintrag gemäß Ihrer Anfrage gefunden werden."); 

<?php
}
?>
-->
</script>
	</head>
	<body></body>
</html>
