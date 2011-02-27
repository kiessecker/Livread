<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true">
</script>
<script type="text/javascript">
dojo.require("dijit.form.Form");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.DateTextBox");
dojo.require("dojox.validate.regexp");
</script>

<?php


# Local vars
$successfully_uploaded=false;
$versionizing=false;





if(isset($_POST["uploadbook"])) {
	?>
	<script type="text/javascript">
	<!--
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
	-->
	</script>
	<?php
	// upload file vorhanden

	$_POST["author"]=trim($_POST["author"]);

	# Zeichenkettenarbeit!

	$_POST["author"]=str_replace("\t","",$_POST["author"]);
	$_POST["author"]=str_replace("\n","",$_POST["author"]);
	$_POST["author"]=str_replace("\r","",$_POST["author"]);
	$_POST["author"]=str_replace("\"","'",$_POST["author"]);
	$_POST["author"]=str_replace("`","",$_POST["author"]);
	$_POST["author"]=str_replace("´","",$_POST["author"]);
	$_POST["author"]=str_replace("/","_slash_",$_POST["author"]);
	$_POST["author"]=str_replace("*","",$_POST["author"]);
	$_POST["author"]=str_replace("|","",$_POST["author"]);
	$_POST["author"]=str_replace(">","",$_POST["author"]);
	$_POST["author"]=str_replace("<","",$_POST["author"]);
	$_POST["author"]=str_replace("&","_ampersand_",$_POST["author"]);

	$_POST["bookname"]=str_replace("\t","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("\n","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("\r","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("\"","'",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("`","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("´","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("/","_slash_",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("*","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("|","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace(">","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("<","",$_POST["bookname"]);
	$_POST["bookname"]=str_replace("&","_ampersand_",$_POST["bookname"]);


	# Wird nie passieren wegen JS validation check
	if(strlen($_POST["author"])<2) $_POST["author"]="Neuer Autor";

	if(!is_dir("./repository/".$_SESSION["username"]."/".$_POST["author"])) {
		application_logger("uploadbook:Erstelle Autorenverzeichnis: ".$_POST["author"],$_SESSION["username"]);
		mkdir("./repository/".$_SESSION["username"]."/".$_POST["author"]);
	}

	$bookname=trim($_POST["bookname"]);
	if(strlen($bookname)<2) $bookname="Neues Buch ".$bookname;
	if(strlen($bookname)>65) $bookname=substr($bookname,0,65);
	$bookname=str_replace("-","_",$bookname);




	if(is_dir("./repository/".$_SESSION["username"]."/".$_POST["author"]."/".$bookname)) {
		application_logger("uploadbook:Buchverzeichnis existiert",$_SESSION["username"]);
	} else {
		application_logger("uploadbook:Erstelle Buchverzeichnis".$bookname,$_SESSION["username"]);
		mkdir("./repository/".$_SESSION["username"]."/".$_POST["author"]."/".$bookname);
	}

	$file_ext = strrchr(basename( $_FILES['uploadedfile']['name']), ".");
	application_logger("uploadbook:Datei-Endung:".$file_ext,$_SESSION["username"]);









	$moveToRepos=false;
	// if actual File exists -> Versionizing with date

	$versionizingString=".versionized.".date("U");
	switch($file_ext) {
		case ".txt":
		case ".oeb":
		case ".mobi":
		case ".rtf":
		case ".lit":
		case ".fb2":
		case ".html":
		case ".htm":
		case ".pdf":
		case ".epub":
			echo "<div id=\"uploadConversionInformationDiv\" style=\"background:black; color:black;\">";
			echo "<span style=\"color:white;\"> Konvertiere ...</span>";
			application_logger("uploadbook:Wir haben calibre nötig:",$_SESSION["username"]);
			$baseDir="./repository/".$_SESSION["username"]."/".$_POST["author"]."/".$bookname;
			$target_path = "./repository/".$_SESSION["username"]."/".$_POST["author"]."/".$bookname . "/".$bookname." - ".$_POST["author"].$file_ext; 
			application_logger("uploadbook:Zielpfad:".$target_path,$_SESSION["username"]);

			if(is_file($baseDir."/".$bookname." - ".$_POST["author"].$file_ext) || 
			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".oeb") ||
			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".mobi") ||
  			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".rtf") ||
			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".lit") ||
			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".fb2") ||
  			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".html") ||
			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".htm") ||
			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".pdf") ||
  			   is_file($baseDir."/".$bookname." - ".$_POST["author"].".epub")) {
				$versionizing=true;
				$versionizingFilesArray=array();
//				$baseDir="./repository/".$_SESSION["username"]."/".$_POST["author"]."/".$bookname;
				if($dh=opendir($baseDir)) {
					while(($file=readdir($dh))!== false) {
						if($file!="." && $file!=".." && 
							(
							eregi("".$file_ext."$",$file) ||
							eregi("\.txt$",$file)
							))
				            		$versionizingFilesArray[]=$file;
					}
					closedir($dh);
				}
				foreach($versionizingFilesArray as $file) {
					$currFileName=$baseDir."/".$file;
					if(!eregi("\.versionized\.[0-9]+",$currFileName))
						rename($currFileName,$currFileName.$versionizingString);
				}
			}

			$moveToRepos=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
			// wenn nicht epub noch reinmachen; target_path ist schon die fertig hochgeladene Datei beliebigen formats; $file_ext ist die Extension der hochgeladenen Datei z.B. ".pdf",...
			
			$output="";
			if(
				$file_ext!=".epub" && 
					(
						isset($_POST["epubconvert"]) || 
						!is_file($baseDir."/".$bookname." - ".$_POST["author"].".epub")
					))

				$output.=livreadEbookConvert2Any($target_path,$file_ext,".epub");



			if($file_ext!=".txt") {
				if(isset($_POST["txtconvert"]) || 
				   !is_file($baseDir."/".$bookname." - ".$_POST["author"].".txt")) {
					$output.=livreadEbookConvert2Any($target_path,$file_ext,".txt");
				}
			}


				echo $output;

			echo "</div>";

		break;
	}




	if($moveToRepos==true) {
		if($versionizing==true) {
			$versionizingString="<br />Der Titel ist bereits vorhanden, deshalb wurde die vorherige Datei versioniert.<br /><br />";
		} else {
			$versionizingString="";
		}

		$successfully_uploaded=true;
		livreadSynchronize();

/* latest inclusion to redirect */
		$sql="SELECT book_id FROM books WHERE book_title='".addslashes($bookname)."' AND book_author='".addslashes($_POST["author"])."' AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
		$result=mysql_query($sql);
		$book="";
		if(mysql_num_rows($result)>0) {
			$row=mysql_fetch_assoc($result);
			$book=$row["book_id"];
		}

		?>
		<script language="Javascript" type="text/javascript">
		<!--

		document.getElementById("uploadConversionInformationDiv").innerHTML="";

//		parent.renderSimpleDialog(,,);

		parent.renderExtendedDialog("Mitteilung","Buch erfolgreich hochgeladen","<?php 
			echo addslashes("Upload des neuen Buches erfolgreich!<br />".$book." ".$versionizingString);
			?>","PAPERFRAME","index.application.php?applicationAction=read&updateApplicationMenu=true&book=<?php echo $book;?>",true);




		//-->
		</script>
		<?php
		// we unset everything that belongs to uploads for having clean new upload possibility after this successful upload
		unset($_GET["author"]);
		unset($_GET["book"]);
		unset($_POST["author"]);
		unset($_POST["bookname"]);
		$successfully_uploaded=false; // we have to, to give show the form anew! Sorry for bad programming






	} else{
?>
		<script language="Javascript" type="text/javascript">
		<!--


		parent.renderSimpleDialog("Meldung","Upload schlug fehl!","<?php 
			echo addslashes("Bitte wählen Sie eine Upload-Datei aus.");
			?>");
		//-->
		</script>

<?php
	}

}
?>











<?php

if($successfully_uploaded==true) {
	return;
}

$book_author="";
$book_title="";

if(isset($_GET["book"])) {
	$sql="SELECT book_id, book_title, book_author FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' AND book_id=".(int)$_GET["book"]." ORDER BY book_author";
	$result=mysql_query($sql);
	$does_book_exist=mysql_num_rows($result);
	if($does_book_exist>0) {
		$data=mysql_fetch_array($result);
		$book_author=$data["book_author"];
		$book_title=$data["book_title"];
	}
} else {
	if(isset($_GET["author"]))
		$book_author=$_GET["author"];
	if(isset($_GET["bookname"]))
		$book_title=$_GET["bookname"];
	if(isset($_POST["author"]))
		$book_author=$_POST["author"];
	if(isset($_POST["bookname"]))
		$book_title=$_POST["bookname"];
}
?>


<h1> Buch hochladen</h1>

<?php if($_SESSION["username"]!="anonymous") { ?>
<div dojoType="dijit.form.Form" id="myFormTwo" jsId="myFormTwo" encType="multipart/form-data" action="index.application.php" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
<?php } ?>

	<table cellpadding="4" cellspacing="0" border="0">
	<tr>
		<td>Autor</td>
		<td>
<input name="author" 
		type="text" 
		id="author" value="<?php echo addslashes($book_author); ?>" 
		required="true" dojoType="dijit.form.ValidationTextBox" 
		regExp="[a-zA-Z0-9|,|\:|;|_|%|\-|ä|ö|ü|Ä|Ö|Ü|ß|á|à|é|è|í|ì|ó|ò|ú|ù|§|@|!|$|?|(|)|\.|\ |\'|&]{2,60}" 
		promptMessage="Bitte geben Sie einen Autorennamen ein.<br />Erlaubt sind alphanumerische Zeichen,<br />Umlaute und einfache Anführungszeichen." />
		</td>
	</tr>
	<tr>
		<td>Buchtitel</td>
		<td>
<input name="bookname" 
		type="text" 
		id="bookname" value="<?php echo addslashes($book_title);?>" 
		required="true" dojoType="dijit.form.ValidationTextBox" 
		regExp="[a-zA-Z0-9|,|\:|;|_|%|\-|ä|ö|ü|Ä|Ö|Ü|ß|á|à|é|è|í|ì|ó|ò|ú|ù|§|@|!|$|?|(|)|\.|\ |\'|&]{2,60}" 
		promptMessage="Bitte geben Sie einen Buchtitel ein ein.<br />Erlaubt sind alphanumerische Zeichen,<br />Umlaute und einfache Anführungszeichen." /></td>
	</tr>
	<tr>
		<td>Datei zum Upload ...</td>
		<td><input name="uploadedfile" type="file" /></td>
	</tr>

	<tr>
		<td></td>
		<td><input type="checkbox" name="txtconvert" /> .txt-Konvertierung<br />
			Die Funktion <em>Vorlese- und Exzerpiermodus</em> benötigt .txt-Dateien. <br />
			Falls die von Ihnen hochgeladene Datei keine .txt-Datei ist, soll dann ausgehend von der 	
			hochgeladenen Datei zusätzlich eine .txt-Datei durch Konvertierung erstellt werden? Merke: wenn
			noch keine .txt-Datei des Buchtitels vorhanden ist, wird automatisch eine .txt-Datei erstellt, 	
			unabhängig von dieser Auswahlbox.
		</td>
	</tr>

	<tr>
		<td></td>
		<td><input type="checkbox" name="epubconvert" /> .epub-Konvertierung<br />
			Der <em>eBook-Modus</em> benötigt .epub-Dateien. <br />
			Falls die von Ihnen hochgeladene Datei keine .epub-Datei ist, soll dann ausgehend von der 	
			hochgeladenen Datei zusätzlich eine .epub-Datei durch Konvertierung erstellt werden? Merke: wenn
			noch keine .epub-Datei des Buchtitels vorhanden ist, wird automatisch eine .epub-Datei erstellt, 				unabhängig von dieser Auswahlbox.
		</td>
	</tr>



	<tr>
		<td colspan="2">
			<p>Erlaubte Eingabeformate: .oeb, .mobi, .rtf, .lit, .fb2, .html, .pdf, .epub, .txt (utf-8)</p>
			<p><strong>Wir empfehlen vorzugsweise konforme .epub-Dateien zu verwenden.</strong></p>
			<p>Zum Verständnis: dieses System benötigt je nach Lesemodus entweder .txt-Dateien oder .epub-Dateien. Es sind jedoch viele Dateiformate zum Upload möglich, aus diesen versucht das System ggf. .txt-Dateien oder .epub-Dateien zu konvertieren. <br />Sie haben jederzeit die Möglichkeit, einzelne Formate des Buches (u.a. .txt, .epub,...) zu aktualisieren, indem sie entweder die Auswahlfelder ankreuzen oder .txt-Dateien, bzw. .epub-Dateien zur Versionierung hochladen. Zur Versionierung wählen Sie im Menü unter dem Eintrag <em>Buch</em> die entsprechende Option. </p>
		</td>
	</tr>
	</table>
	<br />
	<input type="hidden" name="uploadbook" value="true" />
	<input type="hidden" name="applicationAction" value="uploadbook" />
	<input type="hidden" name="updateApplicationMenu" value="true" />




<?php if($_SESSION["username"]=="anonymous") { ?>
 <button dojoType="dijit.form.Button" type="submit" name="btnUpload"
            value="Submit"  onClick="parent.renderSimpleDialog('Demo-Modus','Funktion nicht verfügbar','Diese Funktion ist im Demomodus nicht verfügbar.');return false;">
                Hochladen
            </button>
<?php } else { ?>
 <button dojoType="dijit.form.Button" type="submit" name="btnUpload"
            value="Submit">
                Buchtitel hochladen
            </button>
<?php } ?>
<?php if($_SESSION["username"]!="anonymous") { ?>
</div>
<?php } ?>


<?php

$helpEbookReaderIntegrated="";
$helpEbookReaderIntegrated.="Bitte gib alle erforderlichen Informationen (Buchautor, Buchtitel) ein, und wähle eine eBook-Datei auf deinem Computer. Vorzugsweise solltest Du das epub-Format verwenden.<p>Wenn ein Buch mit selbem Autor und Titel bereits vorhanden ist, wird das bisherige Buch versioniert und das neue an seine Stelle gesetzt.</p>";
$helpEbookReaderIntegrated.="";

?>


<script type="text/javascript">
var tp;
parent.dojo.addOnLoad(function() {
	parent.document.getElementById("paneLeftInfoPane").innerHTML="";
	tp = new parent.dijit.TitlePane({
	    title: "Buchupload",
	    content: "<div id='MyLeftPaneInfoReader'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
});

	parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";

</script>

