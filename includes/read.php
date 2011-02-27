<?php 


# Check if book request is valid
if(!isset($_GET["book"])) exit;
$_GET["book"]=(int)$_GET["book"];
if($_GET["book"]<0) $_GET["book"]=-1;



# Does the user own the book?
$sql="SELECT book_id FROM books WHERE book_id=".addslashes($_GET["book"])." AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
$result=mysql_query($sql);
if(mysql_num_rows($result)<1) {
	?>
<script type="text/javascript">
parent.renderSimpleDialog("Mitteilung","Fehler","Sie besitzen kein Buch, wie Sie es angefordert haben!");
</script>
	</body>
</html>
	<?php
	exit;
}





# We have to initiate repaging ...
if(isset($_GET["repaging"])) {
	$sql="DELETE FROM contents WHERE book_id=".(int)$_GET["book"];
	$resulttemp=mysql_query($sql);

	$sql="DELETE FROM currposition WHERE book_id=".(int)$_GET["book"]." AND username='".addslashes($_SESSION["username"])."'";
		$resulttemp=mysql_query($sql);


	$sql="DELETE FROM bookmarks WHERE book_id=".$_GET["book"];
	$resulttemp=mysql_query($sql);
}


# Checking if book is already paged?
$sql="SELECT book_id FROM contents WHERE book_id=".addslashes($_GET["book"])." ORDER BY book_page ASC LIMIT 0,2";
$result=mysql_query($sql);
if(mysql_num_rows($result)<1) {
	$sql="SELECT * FROM books WHERE book_id=".addslashes($_GET["book"])." LIMIT 0,1";
	$result=mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$contents=$row["original_content"];
	# break content in several peaces and write to database
	# I call it repaging
	$pages=array();
	$contents=ereg_replace("\n","<kie:break/>",$contents);
	$contents=preg_split ("/\s+/", $contents);
	$pagenumber=0;
	for($i=0;$i<count($contents);$i++) {
		$pagenumber++;
		for($j=0;$j<$pagelenghwords;$j++) {
			if(!isset($pages[$pagenumber])) $pages[$pagenumber]=" ";
			$pages[$pagenumber].=" ".@$contents[$i+$j];
		}
		$i=$i+$pagelenghwords-1;
	}
	foreach($pages as $key=>$val) {
		$sql="INSERT INTO contents (
				book_id,
				book_page,
				book_content) VALUES (
			".$_GET["book"].",
			".$key.",
			'".addslashes($val)."')";
		$result=mysql_query($sql);
	}
	$pagestotal=count($pages);
	# Wir machen Meldung
	?>
<script type="text/javascript">
parent.renderExtendedDialog("Mitteilung","Seiten neu umbrochen","Die Seiten für dieses Dokument wurden neu umbrochen. Das Buch hat bei den aktuellen Einstellungen <?php echo $pagestotal;?> Seiten.","PAPERFRAME","index.application.php?applicationAction=read&updateApplicationMenu=true&book=<?php echo $_GET["book"];?>",true);	
</script>
	<?php

} else {
	$sql="SELECT count(book_id) as cnt FROM contents WHERE book_id=".addslashes($_GET["book"]);
	$result=mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$pagestotal=$row["cnt"];
} 


if(isset($_GET["page"]) && $_SESSION["username"]!="anonymous") {
	$sql="SELECT * FROM currposition WHERE book_id=".(int)$_GET["book"]." AND username='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)==0) {
		$sql="INSERT INTO currposition (book_id,current_pagenumber,position_date,username) VALUES (".(int)$_GET["book"].",".(int)$_GET["page"].",'".date("Y-m-d H:i:s")."','".addslashes($_SESSION["username"])."')";
		$result=mysql_query($sql);
	} else {
		$sql="UPDATE currposition SET current_pagenumber=".(int)$_GET["page"].",position_date='".date("Y-m-d H:i:s")."' WHERE book_id=".(int)$_GET["book"]." AND username='".addslashes($_SESSION["username"])."'";
		$result=mysql_query($sql);
	}
} else {
	$sql="SELECT * FROM currposition WHERE book_id=".(int)$_GET["book"]." AND username='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0) {
		$row=mysql_fetch_assoc($result);
		$_GET["page"]=$row["current_pagenumber"];
	}
}



# Do we already have a certain page requested?
$HAVE_BOOKMARK_STRING="";
/*
if(!isset($_GET["page"])) {
	$sql="SELECT * FROM bookmarks WHERE book_id=".$_GET["book"]." AND  username='".addslashes($_SESSION["username"])."' AND reader=".$_SESSION["current_reader"]." ORDER BY bookmark_id DESC LIMIT 0,1";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$HAVE_BOOKMARK_STRING.="Lesezeichen vorhanden. Neuestes: <a href='index.application.php?applicationAction=read&book=".$_GET["book"]."&page=".$row["page_number"]."' tabindex='1'> (Seite ".$row["page_number"]."; vom ".$row["bookmark_date"].")</a>";
	}

}
*/




$sql="SELECT book_title,book_author,book_rating FROM books WHERE book_id=".addslashes($_GET["book"])." ORDER BY book_title LIMIT 0,1";
$result=mysql_query($sql);

$row = mysql_fetch_assoc($result);
$title_of_book=$row["book_title"];
$author=$row["book_author"];
$rating=$row["book_rating"];





if(!isset($_GET["page"]))
	$page=1;
else
	$page=$_GET["page"];


// echo $_SESSION["current_reader"];
// echo "the following is in includes/read.php line 121";
// print_r($_COOKIE);

// include the appropriate reader
require("includes/read.".$APPLICATION_READERS[$_SESSION["current_reader"]]."Reader.php");
//=array(0=>"ebookextended",1=>"ebook",2=>"txt");

