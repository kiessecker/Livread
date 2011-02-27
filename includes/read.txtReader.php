<?php

echo $HAVE_BOOKMARK_STRING;

# We get the paged book data
$sql="SELECT * FROM contents WHERE book_id=".addslashes($_GET["book"])." AND book_page=".$page." LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)<1) {
	echo "Seite existiert nicht.</body/</html>"; exit;
}
$row = mysql_fetch_assoc($result);
$contents=$row["book_content"];
$contents = mb_convert_encoding($contents, "ISO-8859-1");
// kleinere Arbeiten
// $contents=ereg_replace("(\-)+"," - ",$contents);
$contents=ereg_replace("\.",". ",$contents);
$contents=str_replace("<kie:break/>","<br />",$contents);


$sql="UPDATE users SET users_curr_voice_reading_paragraph='".addslashes($contents)."' WHERE users_uid='".addslashes($_SESSION["username"])."'";
mysql_query($sql);

# HTML-Code for HTML-Iframe to locate reading action to and there inside
$contents=str_replace("<br />","\n",$contents);
$contents=str_replace("\n\n","\n",$contents);

echo "<p>";
$screenoutput=str_replace("\n","</p><p>",$contents);
// $screenoutput="<span \">".$screenoutput."</span>";
echo $screenoutput;
echo "</p>";


$navigator="";
if($page>1)
	$navigator.="<a target=\"PAPERFRAME\" href=\"index.application.php?applicationAction=read&book=".$_GET["book"]."&page=".($page-1)."\">Zur&uuml;ck</a>  | ";

		
if(($page+1)<$pagestotal) {
	$navigator.="<a target=\"PAPERFRAME\"  href=\"index.application.php?applicationAction=read&book=".$_GET["book"]."&page=".($page+1)."\">Weiter</a><br />";
} else {
	$navigator.="Buchende<br />";
}
// Buch lesen

$navigator.="Seite ";
if((int)$pagestotal>0) {
	$navigator.="<select class=\"claro dijitSelect\" name=\"getPage\" onChange=\"window.PAPERFRAME.location.href='index.application.php?applicationAction=read&book=".$_GET["book"]."&page='+this.options[this.selectedIndex].value;\">";
	for($pager=1;$pager<=$pagestotal;$pager++) {
		$navigator.="<option";
		if($pager==$page)
			$navigator.=" selected=\"selected\"";
		$navigator.=">".$pager."</option>";
	}
	$navigator.="</select>";
} else
	$navigator.=$page;
$navigator.="/".$pagestotal."<br />";

$navigator.="<a href=\"#\" onClick=\"translateSelection()\">Wort &uuml;bersetzen</a>";

if($_SESSION["username"]!="anonymous")
	$navigator.=" |  <a href=\"#\" onClick=\"noteSelection()\">Notieren</a>";



$helpEbookReaderIntegrated="<div id='applicationInfoDockHelp'>";
$helpEbookReaderIntegrated.="<strong>Seiten umblättern</strong><ul><li>Pfeil(Cursor)-Tasten rechts/links</li><li>siehe Hyperlinks unten zum Vor- und Zurückblättern</li></ul>";
$helpEbookReaderIntegrated.="<p><strong>Wort übersetzen</strong>: Doppelklick auf fragliches Wort.</p>";
$helpEbookReaderIntegrated.="<p><strong>Exzerpieren</strong>: Textbereich mit der Maus markieren und im Menü unter <em>Bearbeiten - Markierung als Notiz</em> klicken, um den gewählten Textbereich als Notiz aufzunehmen.</p>";
$helpEbookReaderIntegrated.="<p><strong>Lesezeichen</strong>: Sie können im Anwendungsmenü beliebig viele Lesezeichen setzen und aufrufen.</p>";
$helpEbookReaderIntegrated.="<p><strong>Vorlesen</strong>: Wählen Sie im <em>Sprachausgabe</em>-Menü die Stimme und Sprache mit der Sie sich vorlesen lassen möchten. Sollte die angezeigte Seite nicht automatisch vorgelesen werden, wählen Sie <em>Start</em>. Um eine Seite erneut vorlesen zu lassen, wählen Sie bitte <em>Seite vorlesen</em>. Beim jeweiligen Umblättern wird die angezeigte Seite vorgelesen. Es empfiehlt sich zum bequemen Vorlesen eine PC-Fernbedienung zu verwenden. Die Belegung der Fernbedienung sollte als uinput (Keyboard-Tastencode der Cursortasten) eingestellt sein.</p>";
$helpEbookReaderIntegrated.="</div>";



?>





<script type="text/javascript">
parent.appReaderType=2;


var menuRating;
var tp;
parent.dojo.addOnLoad(function() {
	if(
		(parent.document.getElementById("MyLeftPaneInfoReader")==null) || 
		(parent.document.getElementById("MyLeftPaneInfoAuthor")==null) || 
		(parent.document.getElementById("MyLeftPaneInfoTitle")==null) || 
		(parent.document.getElementById("MyLeftPaneInfoRating")==null) || 
		(parent.document.getElementById("MyLeftPaneInfoPages")==null) || 
		(parent.document.getElementById("MyLeftPaneReadingNav")==null)
	) {

	
		parent.document.getElementById("paneLeftInfoPane").innerHTML="";
		tp = new parent.dijit.TitlePane({
		    title: "Hilfe zur Bedienung",
		    content: "<div id='MyLeftPaneInfoReader'></div>"
		});
		parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);


		tp = new parent.dijit.TitlePane({
		    title: "Autor/Titel",
		    content: "<div id='MyLeftPaneInfoAuthor'></div><div id='MyLeftPaneInfoTitle'></div>"
		});
		parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
		tp = new parent.dijit.TitlePane({
		    title: "Gesamtseitenzahl",
		    content: "<div id='MyLeftPaneInfoPages'></div>"
		});
		parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
		tp = new parent.dijit.TitlePane({
		    title: "Bewertung",
		    content: "<div id='MyLeftPaneInfoRating'></div>"
		});
		parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
		tp = new parent.dijit.TitlePane({
		    title: "Buchnavigation",
		    content: "<div id='MyLeftPaneReadingNav'></div>"
		});
		parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
		parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";


	}



	parent.document.getElementById("MyLeftPaneInfoRating").innerHTML="";
	menuRating = new parent.dojox.form.Rating({ value:<?php echo (int)$rating;?>, numStars:10,
		    onChange: function() {
			parent.AJAXFRAME.document.location.href="includes/rating.set.php?book=<?php echo $_GET["book"];?>&rating="+menuRating.value;
			menuRating.setDisabled(true);
		    }
	});
	menuRating.placeAt(parent.document.getElementById("MyLeftPaneInfoRating"));
	menuRating.startup();
});


parent.document.getElementById("MyLeftPaneReadingNav").innerHTML="<?php echo addslashes($navigator);?>";
parent.document.getElementById("MyLeftPaneInfoAuthor").innerHTML="<?php echo addslashes($author);?>";
parent.document.getElementById("MyLeftPaneInfoTitle").innerHTML="<em><?php echo addslashes($title_of_book);?></em>";
parent.document.getElementById("MyLeftPaneInfoPages").innerHTML="<?php echo addslashes($pagestotal);?>";











parent.currentBookId=<?php echo $_GET["book"];?>;
parent.currentBookPage=<?php echo $page;?>;
parent.currentBookAuthor="<?php echo $author;?>";
parent.currentBookTitle="<?php echo $title_of_book;?>";





var notebookauthor="<?php echo $author;?>";
var notebooktitle="<?php echo $title_of_book;?>";

var htmllinkback="index.application.php?applicationAction=read&book=<?php echo $_GET["book"]."&page=".($page-1);?>";

var acceptlinkback=<?php if($page>1) echo "true"; else echo "false";?>;
var acceptlinkforth=<?php if($page<$pagestotal) echo "true"; else echo "false";?>;
var htmllinkforth="index.application.php?applicationAction=read&book=<?php echo $_GET["book"]."&page=".($page+1);?>";
var htmllinkbackM="index.application.php?applicationAction=read&book=<?php echo $_GET["book"]."&page=".($page-10);?>";
var htmllinkforthM="index.application.php?applicationAction=read&book=<?php echo $_GET["book"]."&page=".($page+10);?>";


<?php 
if(!isset($_GET["addremovebookmark"]) && !isset($_GET["besilent"])) {
?>
parent.READINGFRAME.location.href="readAloud.txtReader.php?<?php echo SID;?>&rand=<?php echo rand(0,100000000);?>";
<?php } ?>
//-->
</script>


