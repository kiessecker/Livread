<?php
# Dieses Skript ist unabhängig aufrufbar
function livreadDijitMenuItem($container,$mode,$label,$link,$isChecked=false) { 
	echo $container.".addChild(new parent.dijit.".$mode."({";
        echo "\nlabel: \"".addslashes($label)."\",";
	if($mode=="CheckedMenuItem") {
		if($isChecked==true)
			echo "\nchecked: \"true\",";

	}
	echo "\nonClick: function() {";
	echo "\n\t".$link;
	echo "\n}";
	echo "}));";
}

function livreadDijitNewMenu($container) { 
	echo "\nvar ".$container." = new parent.dijit.Menu({});";
}


function livreadDijitMenuBarAddPopupMenuBarItem($container,$label,$objName) {
        echo "\n".$container.".addChild(new parent.dijit.PopupMenuBarItem({";
	echo "\nlabel: \"".addslashes($label)."\",";
	echo "\npopup: ".$objName;
        echo "\n}));";


}

?>
<script language="Javascript" type="text/javascript">
	parent.currentUsersBookmarks=new Array();

	var pMenuBar;
        parent.dojo.addOnLoad(function() {

	    parent.document.getElementById("applicationMenu").innerHTML="";


            pMenuBar = new parent.dijit.MenuBar({});



            var pSubMenuFile = new parent.dijit.Menu({});
            pSubMenuFile.addChild(new parent.dijit.MenuItem({
                label: "Buch &ouml;ffnen ...",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=authors";
                    }            
	    }));





            pSubMenuFile.addChild(new parent.dijit.MenuItem({
                label: "B&uuml;cher hochladen",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=uploadbook";
                    }            
            }));





<?php if($_SESSION["username"]=="anonymous" && ANONYMOUS_MAY_SYNCHRONIZE==false) { ?>
		pSubMenuFile.addChild(new parent.dijit.MenuItem({
			label: "Datenbank synchronisieren",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
            pSubMenuFile.addChild(new parent.dijit.MenuItem({
                label: "Datenbank synchronisieren",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=synchronize&updateApplicationMenu=true";
                    }            
            }));
<?php } ?>




<?php /*

<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuFile.addChild(new parent.dijit.MenuItem({
			label: "Dateimanager",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
            pSubMenuFile.addChild(new parent.dijit.MenuItem({
                label: "Dateimanager",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=filemanager&updateApplicationMenu=true";
                    }            
            }));
<?php } ?>


*/ ?>









<?php
/*
 if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuFile.addChild(new parent.dijit.MenuItem({
			label: "Sprachproxy",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
            pSubMenuFile.addChild(new parent.dijit.MenuItem({
                label: "Sprachproxy",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.speechproxy.php";
                    }            
            }));
<?php } 


*/
?>












            pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
                label: "Datei",
                popup: pSubMenuFile
            }));



        var pSubMenuEdit = new parent.dijit.Menu({});
        pSubMenuEdit.addChild(new parent.dijit.MenuItem({
                label: "Notizen zeigen",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=notes";
                    }            
        }));















        pSubMenuEdit.addChild(new parent.dijit.MenuItem({
                label: "&Uuml;bersetzungen zeigen",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=translations";
                    }            
        }));




<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuEdit.addChild(new parent.dijit.MenuItem({
                label: "&Uuml;bersetzen",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
        pSubMenuEdit.addChild(new parent.dijit.MenuItem({
                label: "&Uuml;bersetzen",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=translateNow";
                    }            
        }));
<?php } ?>








<?php /*
<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuEdit.addChild(new parent.dijit.MenuItem({
			label: "Tageszeitung erstellen",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
        pSubMenuEdit.addChild(new parent.dijit.MenuItem({
                label: "Tageszeitung erstellen",
                    onClick: function() {
			top.location.href="<?php echo NEWSPAPERSERVICE;?>";
                    }            
        }));
<?php } ?>

*/ ?>










        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Bearbeiten",
            popup: pSubMenuEdit
        }));



<?php

if($_SESSION["current_reader"]==2) { ?>


	// speech
        var pSubMenuSpeech = new parent.dijit.Menu({});
        pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
                label: "Stop",
                    onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			parent.sendToReadFrame('readAloud.txtReader.php?action=stop');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP0t)");

<?php } ?>
                    }            
        }));

        pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
                label: "Start",
                    onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			parent.sendToReadFrame('readAloud.txtReader.php?action=start');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP0s)");

<?php } ?>
                    }            
        }));
	

        pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
                label: "Seite vorlesen",
                    onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			parent.sendToReadFrame('readAloud.txtReader.php');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP0r)");

<?php } ?>
                    }            
        }));

<?php 
	if(LoquendoLicensed==true || 
		eregi("kiessecker",$_SESSION["username"]) || 
		eregi("rahel",$_SESSION["username"]) || 
		eregi("arwen",$_SESSION["username"])) {?>





		pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
		        label: "1 MS Mary",<?php ?>
		            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice1');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP03)");

<?php } ?>
		            }            
		}));
		pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
		        label: "2 ATT Mike",
		            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice2');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP03)");

<?php } ?>
		            }            
		}));



		pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
		        label: "3 Loquendo Stefan",
		            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice3');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP05)");

<?php } ?>
		            }            
		}));



		pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
		        label: "4 Loquendo Allison",
		            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice4');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP05)");

<?php } ?>
		            }            
		}));
		pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
		        label: "5 Loquendo Dave",
		            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
			    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice5');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP06)");

<?php } ?>
		            }            
		}));
<?php	} ?>
	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "6 Loquendo Ludoviko",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice6');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP00)");

<?php } ?>
	            }            
	}));
	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "7 Loquendo Steven",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice7');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP08)");

<?php } ?>
	            }            
	}));
	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "8 Loquendo Susan",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice8');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP09)");

<?php } ?>
	            }            
	}));
	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "9 ATT Crystal",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice9');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP07)");

<?php } ?>
	            }            
	}));
	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "10 MS Mike",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice10');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP01)");

<?php } ?>
	            }            
	}));


	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "11 MS Sam",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice11');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP01)");

<?php } ?>
	            }            
	}));


	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "14 Realspeak Yannick",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voice14');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP12)");

<?php } ?>
	            }            
	}));



















	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "Stimme (DE) Katrin.lic (tts.livread.com)",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voiceKatrin');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP12)");

<?php } ?>
	            }            
	}));


	pSubMenuSpeech.addChild(new parent.dijit.MenuItem({
	        label: "Stimme (EN) Allison.lic (tts.livread.com)",
	            onClick: function() {
<?php
	if($_SESSION["may_read"]==1) { ?>
		    	parent.sendToReadFrame('readAloud.txtReader.php?action=voiceAllison');
<?php   } else { ?>
			parent.renderSimpleDialog("Addon","Funktion nicht verfügbar","Diese Funktion ist kostenpflichtig. (SP12)");

<?php } ?>
	            }            
	}));















        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Sprachausgabe",
            popup: pSubMenuSpeech
        }));



	// fin speech



<?php  } ?>











	<?php
		$setReaderModifier="";
		if(isset($_GET["book"])) {
			$setReaderModifier.="&book=".$_GET["book"];
		}
		if(isset($_GET["applicationAction"])) {
			// we trigger a reload of index.application.php within AJAXFRAME only in certain cases 
			// bei diesen kein reload des index.application.php
			// stattdessen menü update in ajaxframe
			if(!in_array($_GET["applicationAction"],array("authors","bookmarks","help","notes","register","login","welcome"))) {
			$setReaderModifier.="&applicationAction=".$_GET["applicationAction"];
			}
		}
		if(isset($_POST["applicationAction"])) 
			$setReaderModifier.="&applicationAction=".$_POST["applicationAction"];
	?>




<?php
	livreadDijitNewMenu("pSubMenuReader");

	if($_SESSION["current_reader"]==0)
		livreadDijitMenuItem("pSubMenuReader","CheckedMenuItem","eBook integriert","parent.AJAXFRAME.location.href=\"set.reader.php?setreader=0".$setReaderModifier."\";",true);
	else
		livreadDijitMenuItem("pSubMenuReader","MenuItem","eBook integriert","parent.AJAXFRAME.location.href=\"set.reader.php?setreader=0".$setReaderModifier."\";");
?>
<?php
/*
	if($_SESSION["current_reader"]==1)
		livreadDijitMenuItem("pSubMenuReader","CheckedMenuItem","eBook frei","parent.AJAXFRAME.location.href=\"set.reader.php?setreader=1".$setReaderModifier."\";",true);
	else
		livreadDijitMenuItem("pSubMenuReader","MenuItem","eBook frei","parent.AJAXFRAME.location.href=\"set.reader.php?setreader=1".$setReaderModifier."\";");

*/
?>
<?php
	if($_SESSION["current_reader"]==2)
		livreadDijitMenuItem("pSubMenuReader","CheckedMenuItem","Vorlese- und Exzerpiermodus","parent.AJAXFRAME.location.href=\"set.reader.php?setreader=2".$setReaderModifier."\";",true);
	else
		livreadDijitMenuItem("pSubMenuReader","MenuItem","Vorlese- und Exzerpiermodus","parent.AJAXFRAME.location.href=\"set.reader.php?setreader=2".$setReaderModifier."\";");


livreadDijitMenuBarAddPopupMenuBarItem("pMenuBar","Lesemodus","pSubMenuReader");


?>









	// fin readerMode


















	// bookmarks
        var pSubMenuBookmarks = new parent.dijit.Menu({});
        pSubMenuBookmarks.addChild(new parent.dijit.MenuItem({
                label: "Alle Lesezeichen",
                    onClick: function() {
			parent.PAPERFRAME.location.href="index.application.php?applicationAction=bookmarks";
                    }            
        }));


<?php
	$countBookmarksForMenu=0;
	$sql="SELECT bookmarks.book_id,books.book_id,books.book_title,bookmarks.page_number,bookmarks.bookmark_date, bookmarks.bookmark_name,bookmarks.component FROM bookmarks,books WHERE bookmarks.username='".addslashes($_SESSION["username"])."' AND  bookmarks.reader=".$_SESSION["current_reader"]." AND bookmarks.book_id=books.book_id ORDER BY bookmarks.bookmark_id DESC LIMIT 0,100";
	$result=mysql_query($sql);
	$bookArray=array();
	while ($row = mysql_fetch_assoc($result)) {


		if(!in_array($row["book_title"],$bookArray) && MAX_BOOKMARKS_IN_MENU>$countBookmarksForMenu) {
		$countBookmarksForMenu++;
		?>


			// we add to bookmarks
			parent.currentUsersBookmarks.push("<?php echo $row["book_id"];?>");


			pSubMenuBookmarks.addChild(new parent.dijit.MenuItem({
				label: "<?php
					echo addslashes(str_replace("\"","'",str_replace(";","-",htmlspecialchars($row["book_title"])))." ".$row["bookmark_name"].")");
		?>",
				    onClick: function() {
					parent.livreadGotoBookmark(<?php echo $row["book_id"];?>,<?php echo $row["page_number"];?>,"<?php echo $row["component"];?>",1);
				    }            
			}));
			<?php

			$bookArray[]=$row["book_title"];
		}
	}





?>
        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Lesezeichen",
            popup: pSubMenuBookmarks
        }));



	// fin bookmarks



	// author
        var pSubMenuAuthor = new parent.dijit.Menu({});

<?php
	$showAuthorMenu=false;
	if(isset($_GET["book"])) {
		$sql="SELECT book_id,book_author FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' AND book_id=".(int)$_GET["book"]." ORDER BY book_author";
		$result=mysql_query($sql);
		$does_book_exist=mysql_num_rows($result);
		if($does_book_exist>0) {
			$result=mysql_fetch_array($result);
			$showAuthorMenu=true;
			$currentAuthor=$result["book_author"];
		}
	}

	if($showAuthorMenu==true) { 

?>




<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuAuthor.addChild(new parent.dijit.MenuItem({
			label: "Neues Buch dieses Autors hochladen",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
		pSubMenuAuthor.addChild(new parent.dijit.MenuItem({
		        label: "Neues Buch dieses Autors hochladen",
		            onClick: function() {
				parent.PAPERFRAME.location.href="index.application.php?applicationAction=uploadbook&author=<?php echo urlencode($currentAuthor);?>";
		            }            
		}));
<?php } ?>













<?php

			$sql="SELECT book_author, book_title,book_id FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' AND book_author='".addslashes($currentAuthor)."' ORDER BY book_title ASC LIMIT 0,12";
			$result=mysql_query($sql);
			while($row=mysql_fetch_array($result)) {
?>

		pSubMenuAuthor.addChild(new parent.dijit.MenuItem({
		        label: "<?php echo addslashes(htmlspecialchars($row["book_title"]));?>",
		            onClick: function() {
				parent.PAPERFRAME.location.href="index.application.php?applicationAction=read&updateApplicationMenu=true&book=<?php echo $row["book_id"];?>";
		            }            
		}));



<?php
			}

?>
        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Autor",
            popup: pSubMenuAuthor
        }));


<?php
	} 
?>	
	// fin author

	// book

        var pSubMenuBook = new parent.dijit.Menu({});


<?php
	if(isset($_GET["book"])) {

		$sqlx="SELECT * FROM contents WHERE book_id=".addslashes($_GET["book"])." ORDER BY book_page ASC";
		$resultx=mysql_query($sqlx);
		$pagestotal=mysql_num_rows($resultx);
		$tmppage=1;
		if(isset($_GET["page"]))
			$tmppage=$_GET["page"];
		$sqlx="SELECT * FROM bookmarks WHERE book_id=".$_GET["book"]." AND page_number=".$tmppage;
		$resultx=mysql_query($sqlx);
		if(mysql_num_rows($resultx)>0) {
			$bookmarkedString="aktuell gesetzt";
		} else {
			$bookmarkedString="kein";
		}
		?>



<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Lesezeichen setzen/entfernen",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Lesezeichen setzen/entfernen",
			    onClick: function() {
				parent.switchBookmark();
			    }            
		}));
<?php } ?>



<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Markierung als Notiz",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Markierung als Notiz",
			    onClick: function() {
				parent.noteSelection();
			    }            
		}));
<?php } ?>











		<?php
			$sql="SELECT * FROM bookmarks,books WHERE bookmarks.book_id=books.book_id AND  bookmarks.reader=".$_SESSION["current_reader"]." HAVING books.book_id=".$_GET["book"]." ORDER BY bookmarks.bookmark_id DESC LIMIT 0,3";
			$result=mysql_query($sql);
			while ($row = mysql_fetch_assoc($result)) {

			?>

			// we add to bookmarks
			parent.currentUsersBookmarks.push("<?php echo $row["book_id"];?>");



			pSubMenuBook.addChild(new parent.dijit.MenuItem({
				label: "<?php 
echo addslashes("Lesezeichen ".$row["bookmark_name"]);
?>",
				    onClick: function() {
					parent.livreadGotoBookmark(<?php echo $row["book_id"];?>,<?php echo $row["page_number"];?>,"<?php echo $row["component"];?>",0);


				    }            
			}));


			<?php
				
			}  

?>





<?php 
// show repaging menu only for plaintext reader
if($_SESSION["current_reader"]==2) {  
?>

<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Repaging (entfernt jedoch alle Bookmarks)",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Repaging (entfernt jedoch alle Bookmarks)",
			    onClick: function() {
				parent.PAPERFRAME.location.href="index.application.php?applicationAction=read&book=<?php echo $_GET["book"];?>&repaging=true";
			    }            
		}));
<?php } ?>

<?php } ?>









<?php
			$sql="SELECT book_id FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' AND book_id=".(int)$_GET["book"]." ORDER BY book_author";
			$result=mysql_query($sql);
			$does_book_exist=mysql_num_rows($result);
			if($does_book_exist>0) {
?>










<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Neue Version oder neues Format dieses Buches hochladen",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Neue Version oder neues Format dieses Buches hochladen",
			    onClick: function() {
parent.renderExtendedDialog("Meldung","Neue Version oder neues Format hochladen","Sind Sie sicher, daß Sie eine neue Version oder ein neues Format dieses Buches hochladen wollen? Wenn Sie dabei die Erstellung einer .txt-Datei erzwingen, gehen für dieses Buch gesetzte Lesezeichen verloren.","PAPERFRAME","index.application.php?applicationAction=uploadbook&book=<?php echo $_GET["book"];?>",false);

			    }            
		}));
<?php } ?>






















<?php if($_SESSION["username"]=="anonymous") { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Buch entfernen",
			    onClick: function() {
				parent.renderSimpleDialog("Demo-Modus","Funktion nicht verfügbar","Diese Funktion ist im Demomodus nicht verfügbar.");
			    }            
		}));
<?php } else { ?>
		pSubMenuBook.addChild(new parent.dijit.MenuItem({
			label: "Buch entfernen",
			    onClick: function() {
parent.renderExtendedDialog("Meldung","Aktuelles Buch entfernen","Sind Sie sicher, daß Sie dieses Buch entfernen wollen?","AJAXFRAME","book.delete.php?book=<?php echo $_GET["book"];?>",false);

			    }            
		}));
<?php } ?>












<?php
			}

?>
        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Buch",
            popup: pSubMenuBook
        }));

<?php
 } ?>









	// fin book

	// login
        var pSubMenuLogin = new parent.dijit.Menu({});





<?php



	$sqlx="SELECT bookmarks.bookmark_id, books.book_title, bookmarks.book_id, bookmarks.page_number FROM bookmarks,books WHERE books.book_id=bookmarks.book_id AND bookmarks.username='".addslashes($_SESSION["username"])."' ORDER BY bookmarks.bookmark_id DESC LIMIT 0,1";
// 	echo $sqlx;
	$resultx=mysql_query($sqlx);
	if(mysql_num_rows($resultx)>0) {
		$bookmarkedString="aktuell gesetzt";
		while ($row = mysql_fetch_assoc($resultx)) {

?>
	// we add to bookmarks
	parent.currentUsersBookmarks.push("<?php echo $row["book_id"];?>");

	pSubMenuLogin.addChild(new parent.dijit.MenuItem({
		label: "Letztes Lesezeichen: <?php echo addslashes($row["book_title"]);?>",
		    onClick: function() {
		   	parent.PAPERFRAME.location.href="index.application.php?applicationAction=read&updateApplicationMenu=true&book=<?php echo $row["book_id"];?>&page=<?php echo $row["page_number"];?>";

		    }            
	}));


<?php

		}
	}


?>


<?php if($_SESSION["username"]!="anonymous") { ?>
	pSubMenuLogin.addChild(new parent.dijit.MenuItem({
		label: "Angemeldet als <?php echo $_SESSION["username"];?>: Einstellungen",
		    onClick: function() {
		   	parent.PAPERFRAME.location.href="index.application.php?applicationAction=preferences";

		    }            
	}));
	pSubMenuLogin.addChild(new parent.dijit.MenuItem({
		label: "Einstellungen <?php echo $_SESSION["username"];?>",
		    onClick: function() {
		   	parent.PAPERFRAME.location.href="index.application.php?applicationAction=preferences";

		    }            
	}));
<?php } ?>


<?php if($_SESSION["username"]!="anonymous") { ?>
	pSubMenuLogin.addChild(new parent.dijit.MenuItem({
		label: "Abmelden",
		    onClick: function() {
		   	parent.PAPERFRAME.location.href="index.application.php?applicationAction=logout&logout=true";

		    }            
	}));
<?php } ?>

<?php if($_SESSION["username"]=="anonymous") { ?>
	pSubMenuLogin.addChild(new parent.dijit.MenuItem({
		label: "Anmelden/Registrieren",
		    onClick: function() {
		   	parent.PAPERFRAME.location.href="index.application.php?applicationAction=login";

		    }            
	}));
<?php } ?>





        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Sitzung",
            popup: pSubMenuLogin
        }));


	// fin login

	// help
        var pSubMenuHelp = new parent.dijit.Menu({});

	pSubMenuHelp.addChild(new parent.dijit.MenuItem({
		label: "Inhalt",
		    onClick: function() {
		   	parent.PAPERFRAME.location.href="index.application.php?applicationAction=help";

		    }            
	}));


	pSubMenuHelp.addChild(new parent.dijit.MenuItem({
		label: "Info über Livread.com",
		    onClick: function() {
			parent.copyrightInfo();
		    }            
	}));



        pMenuBar.addChild(new parent.dijit.PopupMenuBarItem({
            label: "Hilfe",
            popup: pSubMenuHelp
        }));


	// fin help



            pMenuBar.placeAt(parent.document.getElementById("applicationMenu"));
            pMenuBar.startup();
        });
    </script>


