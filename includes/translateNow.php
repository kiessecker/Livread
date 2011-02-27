<?php
# Individually load dojo on need 
?>
<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true">
</script>
<script type="text/javascript">
dojo.require("dijit.form.Form");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.DateTextBox");
dojo.require("dojox.validate.regexp");
</script>




<div dojoType="dijit.form.Form" id="myFormTwo" jsId="myFormTwo" encType="multipart/form-data"
        action="index.application.php" method="post">

<input name="word" type="text" id="word" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte geben Sie Ihren Suchbegriff ein." />

<input type="hidden" name="applicationAction" value="translateNow" />

 <button dojoType="dijit.form.Button" type="submit" name="btnSearchTrans"
            value="Submit">
                Suche starten
            </button>

<input type="radio" name="direction" value="ED" checked="checked" />Englisch-Deutsch
<input type="radio" name="direction" value="DE" />Deutsch-Englisch
</div>

<?php


function modifyTerm($term) {
	if(substr($term,strlen($term)-1,1)=="s") {
		$term=substr($term,0,strlen($term)-1);
		return $term;
	}

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

	return $term;
}



if(isset($_POST["word"])) {


	$db = mysql_connect("localhost",$mysql_user,$mysql_pass) or die("DB error");
	mysql_select_db($mysql_db_trans, $db);


	$_POST["word"]=trim($_POST["word"]);

	$output="";


	$dir=$_POST["direction"];

	if($dir=="ED") {
		$query="SELECT ed_value FROM ed WHERE ed_key='".addslashes(trim($_POST["word"]))."' LIMIT 0,1";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		    $output.=$row[0]; 
		}
	} else {
		$query="SELECT ed_value FROM ed WHERE ed_value LIKE '%".addslashes(trim($_POST["word"]))."%' LIMIT 0,1";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		    $output.=$row[0]; 
		}
	}
	

	$_POST["word"]=modifyTerm($_POST["word"]);

	
//	echo $_GET["word"];
//	echo "\n\n";


	if($dir=="ED") {
		$query="SELECT ed_value FROM ed WHERE ed_key LIKE '".addslashes(trim($_POST["word"]))."%' LIMIT 0,20";
		$result = mysql_query($query);
	} else {
		$query="SELECT ed_value FROM ed WHERE ed_value LIKE '%".addslashes(trim($_POST["word"]))."%' LIMIT 0,20";
		$result = mysql_query($query);
	}

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	    $output.=$row[0];  
	}

	$output=str_replace("<img","<tmp",$output);
	$html=$output;

//	$html=strip_tags($html,"<div>");
	$html=ereg_replace("\<div height\=\"2\"\>","<div>",$html);
	$html=ereg_replace("\<img hspace=\"[0]+\" align=\"[a-z]+\" lorecindex=\"[0-9]+\" recindex=\"[0-9]+\" hirecindex=\"[0-9]+\"/>","",$html);


	$html=ereg_replace("\height=\"[0-9]+\"","",$html);
	$html=ereg_replace("\<small\>","",$html);
	$html=ereg_replace("\<\/small\>","",$html);


	$html=ereg_replace("\<blockquote\>","<p>",$html);
	$html=ereg_replace("\<\/blockquote\>","</p>",$html);



	$html=iconv("ISO-8859-1", "UTF-8", $html);

?>
<script type="text/javascript">
parent.document.getElementById("dialogdiv").innerHTML="<?php echo addslashes($html); ?>";
parent.renderDojoTranslationDialog();
</script>

<?php
}
?>

