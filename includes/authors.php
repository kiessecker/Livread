<?php /*<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true"></script>*/?>
<script type="text/javascript" src="/specialdj/dojo/dojo.js" djConfig="parseOnLoad: true"></script>

<script type="text/javascript">
dojo.require("dijit.Menu");
dojo.require("dijit.MenuItem");
dojo.require("dojo.data.ItemFileReadStore");
dojo.require("dijit.Tree");
</script>


<?php


# Create Books map
$fh=fopen("./temp/".$_SESSION["username"].".json","w+");
fwrite($fh,"{\nidentifier: 'id',\nlabel: 'name',\nitems: [\n");
$authorarray=array();
	
$sql="SELECT book_author FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%'  ORDER BY book_author";
$result=mysql_query($sql);
$countbooks=mysql_num_rows($result);
$js_urls="";
while ($row = mysql_fetch_assoc($result)) {
	if(!in_array($row["book_author"],$authorarray)) {


		$childrenIds=array();
		$children=array();
		$titleIdArray=array();

		$sql2="SELECT book_id,book_title FROM books WHERE book_author='".addslashes($row["book_author"])."' AND book_path LIKE './repository/".$_SESSION["username"]."/%'  ORDER BY book_title";
		$result2=mysql_query($sql2);


		while ($row2 = mysql_fetch_assoc($result2)) {


			
			$currmd5idtitle=md5($row["book_author"]."-x-".$row2["book_title"]);
			

			if(!in_array($currmd5idtitle,$titleIdArray)) {

######### Implemented later:
			$formatArray=array();
			$baseDir="./repository/".$_SESSION["username"]."/".$row["book_author"]."/".$row2["book_title"];
			if($dh=@opendir($baseDir)) {
				while(($file=readdir($dh))!== false) {
					if($file!="." && $file!="..")
						$formatArray[]=$file;
				}
				closedir($dh);
			}
			$outstring=" | ";
			foreach($formatArray as $file) {
				$path_info = pathinfo($file);
				$outstring.=" ".$path_info['extension'];
			}

######### /Fin Implementation


				$titleIdArray[]=$currmd5idtitle;
				$js_urls.="\nbookIds[\"".$currmd5idtitle."\"]=".$row2["book_id"].";";

				$childrenIds[]="{_reference:'".$currmd5idtitle."'}";
				$children[]="\n{ id: '".$currmd5idtitle."', name:'".addslashes($row2["book_title"])." ".$outstring."', type:'country' }";
			}

		}




	        fwrite($fh,"\n\n\n{ id: '".md5($row["book_author"])."', name:'".addslashes($row["book_author"])."', writer:'".addslashes($row["book_author"])."', type:'author',");
		fwrite($fh,"\nchildren:[".implode(",",$childrenIds)."]},");
		foreach($children as $row3) {
			fwrite($fh,"\n\t".$row3.",");
		}








	}
	$authorarray[]=$row["book_author"];
}

fwrite($fh,"	        { id: 'IT', name:'Italy', type:'country' }");
fwrite($fh,"\n]}");

if($countbooks==0) 
	$countBookString="<p>Du hast noch keine B&uuml;cher hochgeladen. Verwende <a href=\"index.application.php?applicationAction=uploadbook\"><em>Datei &#9654; B&uuml;cher hochladen</em></a> oder klicke <a href=\"index.application.php?applicationAction=uploadbook\">hier</a>, um ein eBook hochzuladen.</p>";
else {
	if($countbooks==1) 
		$countBookString="<p>Du hast ".$countbooks." Buch in Deiner Online Bibliothek.</p>";
	else
		$countBookString="<p>Du hast ".$countbooks." B&uuml;cher in Deiner Online Bibliothek.</p>";
}
?>
<script type="text/javascript">
	var bookIds = new Array();
	<?php echo $js_urls; ?>
	function openBook(id,mode) {
		switch(mode) {
			case "txt":
				location.href="index.application.php?applicationAction=read&updateApplicationMenu=true&book="+bookIds[id];
			break;
			case "favouriteTXT":
				location.href="index.application.php?applicationAction=read&updateApplicationMenu=true&book="+id;
			break;

			case "ebook":
				parent.location.href="ebook.php?book="+bookIds[id];
			break;

		}
	}
	function uploadBookOfAuthor(author) {
		location.href="index.application.php?applicationAction=uploadbook&author="+escape(author);
	}
	function uploadVersion(id) {
		location.href="index.application.php?applicationAction=uploadbook&book="+bookIds[id];
	}
	function openBookProperties(id) {
		location.href="index.application.php?applicationAction=properties&book="+bookIds[id];
	}
	function downloadBook(id) {
		location.href="index.application.php?applicationAction=download&book="+bookIds[id];
	}
	function deleteBook(id) {
parent.renderExtendedDialog("Meldung","Dieses Buch entfernen?","Sind Sie sicher, daß Sie dieses Buch entfernen wollen?","AJAXFRAME","book.delete.php?book="+bookIds[id]+"&backto=authors",false);
	}

</script>


        <div dojoType="dijit.Menu" id="tree_menu" style="display: none;" onMouseLeave="dijit.popup.close(this)">
            <div dojoType="dijit.MenuItem" id="ctxMenuOpenBookTXT" onClick="openBook(currentId,'txt');">
                Buch öffnen im Standardmodus 
            </div>
            <div dojoType="dijit.MenuItem" id="ctxMenuOpenBook" onClick="openBook(currentId,'ebook');">
                Buch öffnen im eBook-Modus 
            </div>
    	    <div dojoType="dijit.MenuSeparator"></div>
            <div dojoType="dijit.MenuItem" id="ctxMenuBookDownload" onClick="downloadBook(currentId);">
                Buch herunterladen
            </div>
	    <div dojoType="dijit.MenuItem" id="ctxMenuBookProperties" onClick="openBookProperties(currentId);">
	        Bucheigenschaften
	    </div>
	    <div dojoType="dijit.MenuItem" id="ctxMenuBookUpload" onClick="uploadBookOfAuthor(currentAuthor);">
	        Neues Buch dieses Autors hochladen
	    </div>
            <div dojoType="dijit.MenuItem" id="ctxMenuUploadVersion" onClick="uploadVersion(currentId);">
                Neue Version/Neues Format hochladen
	    </div>
            <div dojoType="dijit.MenuItem" id="ctxMenuBookDelete" onClick="deleteBook(currentId);">
                Buch löschen
            </div>



        </div>

















        <div dojoType="dojo.data.ItemFileReadStore" jsId="continentStore" url="temp/<?php 
echo $_SESSION["username"];?>.json">
        </div>
        <div dojoType="dijit.tree.ForestStoreModel" jsId="continentModel" store="continentStore"
        query="{type:'author'}" rootId="continentRoot" rootLabel="Continents"
        childrenAttrs="children">
        </div>
<div style="width:80%;border:1px gray;">
        <div dojoType="dijit.Tree" id="mytree2" model="continentModel" showRoot="false" openOnClick="true">
            <script type="dojo/connect">
                var menu = dijit.byId("tree_menu");
                // when we right-click anywhere on the tree, make sure we open the menu
                menu.bindDomNode(this.domNode);

                dojo.connect(menu, "_openMyself", this, function(e) {
                    // get a hold of, and log out, the tree node that was the source of this open event
                    var tn = dijit.getEnclosingWidget(e.target);
		    currentId = tn.item.id;
		    currentName= tn.item.name;
		    currentAuthor= tn.item.writer;
	if(!currentAuthor) {
		/* We are within books */
		    dijit.byId("ctxMenuBookUpload").attr("disabled",false);
		    dijit.byId("ctxMenuOpenBook").attr("disabled",false);
		    dijit.byId("ctxMenuOpenBookTXT").attr("disabled",false);
		    dijit.byId("ctxMenuUploadVersion").attr("disabled",false);
		    dijit.byId("ctxMenuBookProperties").attr("disabled",false);
		    dijit.byId("ctxMenuBookDownload").attr("disabled",false);
		    dijit.byId("ctxMenuBookDelete").attr("disabled",false);


	} else {
		/* We are within authors */
		    dijit.byId("ctxMenuBookUpload").attr("disabled",false);
		    dijit.byId("ctxMenuOpenBook").attr("disabled",true);
		    dijit.byId("ctxMenuOpenBookTXT").attr("disabled",true);
		    dijit.byId("ctxMenuUploadVersion").attr("disabled",true);
		    dijit.byId("ctxMenuBookProperties").attr("disabled",true);
		    dijit.byId("ctxMenuBookDownload").attr("disabled",true);
		    dijit.byId("ctxMenuBookDelete").attr("disabled",true);
	}
	/* after the other conditionalities */
	if(!currentAuthor) {
		var tnAuthor = tn.getParent().item.writer;
		currentAuthor=tnAuthor;
	}




/*
                    menu.getChildren().forEach(function(i) {
                        i.attr('disabled', tn.item.children);
                    });
*/
                    // IMPLEMENT CUSTOM MENU BEHAVIOR HERE
                });
            </script>


		<script type="dojo/method" event="onClick" args="item">
		openBook(continentStore.getValue(item, "id"),"txt");
		</script>

        </div>
</div>

	<?php echo $countBookString;?>

<?php

$helpEbookReaderIntegrated="";
$helpEbookReaderIntegrated.="Hier findest Du alle Autoren.<p>Bitte klicke auf das jeweilige Plus-Zeichen eines Autors, um die Bücher des Autoren anzuzeigen.</p><p>Wenn Du mit der linken Maustaste einen Buchtitel anklickst, wird er im aktuellen Lesemodus geöffnet.</p><p>Bitte klicke mit der rechten Maustaste auf Autor oder Buchtitel, um erweiterte Funktionen aufzurufen.</p><p>Livread merkt sich deine ausgeklappten Autoren.</p>";
$helpEbookReaderIntegrated.="";



$helpEbookReaderFavourites="Favoriten (3 und mehr Sterne)";
$sql="SELECT book_author, book_title, book_id, book_rating FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' AND book_rating >= 3 ORDER BY book_rating DESC";
$result=mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) {
	$helpEbookReaderFavourites.="<div style=\\\"border:1px solid;margin-bottom:1px; background-color:#cccccc\\\" onClick=\\\"window.PAPERFRAME.openBook(".$row["book_id"].",'favouriteTXT');\\\">".$row["book_title"]." - ".$row["book_author"].$row["book_rating"]."</div>";

}



?>


<script type="text/javascript">
var tp;
parent.dojo.addOnLoad(function() {
	parent.document.getElementById("paneLeftInfoPane").innerHTML="";
	tp = new parent.dijit.TitlePane({
	    title: "Bibliothek",
	    content: "<div id='MyLeftPaneInfoReader'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);

	tp = new parent.dijit.TitlePane({
	    title: "Favoriten",
	    content: "<div id='MyLeftPaneFavorites'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);

});

	parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";
	parent.document.getElementById("MyLeftPaneFavorites").innerHTML="<?php echo $helpEbookReaderFavourites;?>";




</script>



