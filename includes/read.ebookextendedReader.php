<?php


# Make an alias for easier use
$book_id=$_GET["book"];

# Does the user own the book?
if(false==livreadDoesUserOwnBook($book_id))
	die("Error #45335423 You do not own book with this id");

# Retrieve ALL book contents as array, both manifest and book data and complete output
$output=livreadCreateEpubContentForReader($book_id,0); // with 1 all things are processed anytime
# but we do not use the "output" value from the array, because we tell the javascript to access
# the unzipped book itself






# We create the toc array for the book readers javascript to provide table of contents
$toc=array();
foreach($output["TOC"] as $key=>$value) {
	$toc_title=$output["TOC"][$key]["name"];
	$toc_fileurl=$output["TOC"][$key]["fileName"];
	$toc[]="\n{\ntitle: \"".addslashes($toc_title)."\",\nsrc: \"".addslashes($output["BOOKINFO"]["urlprefix"].$toc_fileurl)."\"\n}";
}
$toc=implode(",",$toc);




?>  <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <meta http-equiv="Content-Type" content="text/htmlcharset=utf-8"/>
		<script type="text/javascript">
		var livReadEbookBookID=<?php echo $_GET["book"];?>;
		</script>
		<script src="js/jquery.js" type="text/javascript"></script>
		<!-- READER CORE COMPONENT -->
		<script type="text/javascript" src="js/reader/monocle.js"></script>
		<script type="text/javascript" src="js/reader/compat.js"></script>
		<script type="text/javascript" src="js/reader/reader.js"></script>
		<script type="text/javascript" src="js/reader/book.js"></script>
		<script type="text/javascript" src="js/reader/component.js"></script>
		<script type="text/javascript" src="js/reader/place.js"></script>
		<script type="text/javascript" src="js/reader/styles.js"></script>
		<!-- READER FLIPPERS -->
		<script type="text/javascript" src="js/reader/flippers/slider.js"></script>
		<script type="text/javascript" src="js/reader/flippers/legacy.js"></script>
		<!-- READER STANDARD CONTROLS -->
		<script type="text/javascript" src="js/reader/controls/placesaver.js"></script>
		<script type="text/javascript" src="js/reader/controls/magnifier.js"></script>
		<script type="text/javascript" src="js/reader/controls/scrubber.js"></script>
		<script type="text/javascript" src="js/reader/controls/spinner.js"></script>
		<script type="text/javascript" src="js/reader/controls/contents.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/ebook.css" />
		<script type="text/javascript">
		parent.appReaderType=0;
		function livreadLink(livreadChapter) {
			window.setTimeout("reader1.skipToChapter('"+livreadChapter+"')", 1000);
		}


		  (function () {

		    with (Monocle.Styles) {
		    container.background = "none";
		    container.right = "24px";
		    container.left = '0';
		//    container.width = ""+(applicationWidth-60)+"px"; /* it's better to query this with jQuery than setting to "auto" 
		//							because on slower engines this causes slide border errors*/
		    page.top = page.bottom = "6px";
		    page["-webkit-box-shadow"] = "1px 0 2px #997";
		    page["-moz-box-shadow"] = "1px 0 2px #997";
		    page["-webkit-border-top-left-radius"] = "26px 4px";
		    page["-webkit-border-bottom-left-radius"] = "26px 4px";
		    page["-moz-border-radius-topleft"] = "26px 4px";
		    page["-moz-border-radius-bottomleft"] = "26px 4px";
		    page['background-color'] = "#FFFEFC";
		    page['background-image'] =
		      "-moz-linear-gradient(0deg, #EDEAE8 0px, #FFFEFC 24px)";
		    page.background =
		      "-webkit-gradient(linear, 0 0, 24 0, from(#EDEAE8), to(#FFFEFC))";
		    scroller.top = scroller.bottom = "2.5em";
		    scroller.left = "1em";
		    scroller.right = "1em";
		    content.color = "#310";
		    content["font-family"] = "Palatino, Georgia, serif";
		    content["line-height"] = "130%";
		    Controls.Magnifier.button.color = "#632";
		    Controls.Magnifier.button.padding = "3px 6px";
		    Controls.Magnifier.button['-webkit-border-radius'] = "3px";
		    Controls.Magnifier.button.background = "#FFF";
		    Controls.Magnifier.button.top = "8px";
		    Controls.Contents.container.background = "#E0D3C0";
		    Controls.Contents.container.border = "1px solid #EEd";
		    Controls.Contents.list.font = "11pt Georgia, serif";
		    Controls.Contents.list.color = "#642";
		    Controls.Contents.list['text-shadow'] = "1px 1px #FFF6E0";
		    Controls.Contents.chapter['border-bottom'] = "2px groove #FFF6E9";
		  }




		      var bookData = {
			getComponents: function () {
			  return [
				<?php
					$files="'".implode("','",$output["FILES_OF_BOOK"])."'";
					echo $files;

				?>
			  ];
			},
			getContents: function () {
			  return [
				<?php echo $toc; ?>
			  ]
			},
			getComponent: function (cmptId) {
			  var ajReq = new XMLHttpRequest();
			  ajReq.open("GET", cmptId, false);
			  ajReq.send(null);
			  return ajReq.responseText;
			},
			getMetaData: function(key) {
			  return {
			    title: "<?php echo addslashes($output["BOOKINFO"]["title"]);?>",
			    creator: "<?php echo addslashes($output["BOOKINFO"]["creator"]);?>"
			  }[key];
			}
		      }




		      // Initialize the reader1 element.
		      Monocle.addListener(
			window,
			'load',
			function () {

			  // PLACESAVER
			  window.reader1 = Monocle.Reader('placesaver', bookData);

			/* Because the 'reader1' element changes size on window resize,
		       	 * we should notify it of this event. */
		      	Monocle.addListener(
		      	  window,
		      	  'resize',
		      	  function () { 

		//		alert(applicationWidth);
		//    		window.reader1.Styles.container.width = ""+(applicationWidth-60)+"px";
				window.reader1.resized()
				 }
		      	);



			  var placeSaver = new Monocle.Controls.PlaceSaver(reader1);
			  var magnifier = new Monocle.Controls.Magnifier(reader1);
			  var scrubber = new Monocle.Controls.Scrubber(reader1);
			  reader1.addControl(placeSaver, 'invisible');
			  reader1.addControl(magnifier, 'page');





		      /* BOOK TITLE RUNNING HEAD */
		      var bookTitle = {}
		      bookTitle.contentsMenu = Monocle.Controls.Contents(reader1);
		      reader1.addControl(bookTitle.contentsMenu, 'popover', { hidden: true });
		      bookTitle.createControlElements = function () {
			var cntr = document.createElement('div');
			cntr.className = "bookTitle";
			var runner = document.createElement('div');
			runner.className = "runner";
			runner.innerHTML = reader1.getBook().getMetaData('title');
			cntr.appendChild(runner);

			Monocle.addListener(
			  cntr,
			  typeof Touch == "object" ? "touchstart" : "mousedown",
			  function (evt) {
			    if (evt.preventDefault) {
			      evt.stopPropagation();
			      evt.preventDefault();
			    } else {
			      evt.returnValue = false;
			    }
			    reader1.showControl(bookTitle.contentsMenu);
			  }
			);

			return cntr;
		      }



		      reader1.addControl(bookTitle, 'page');


		      /* CHAPTER TITLE RUNNING HEAD */
		      var chapterTitle = {
			runners: [],
			createControlElements: function (page) {
			  var cntr = document.createElement('div');
			  cntr.className = "chapterTitle";
			  var runner = document.createElement('div');
			  runner.className = "runner";
			  cntr.appendChild(runner);
			  this.runners.push(runner);
			  this.update(page);
			  return cntr;
			},
			update: function (page) {
			  var place = reader1.getPlace(page);
			  this.runners[page.pageIndex].innerHTML = place.chapterTitle();
			}
		      }
		      reader1.addControl(chapterTitle, 'page');
		      reader1.addListener(
			'monocle:pagechange',
			function (evt) { chapterTitle.update(evt.monocleData.page); }
		      );


		      /* PAGE NUMBER RUNNING HEAD */
		      var pageNumber = {
			runners: [],
			createControlElements: function (page) {
			  var cntr = document.createElement('div');
			  cntr.className = "pageNumber";
			  var runner = document.createElement('div');
			  runner.className = "runner";
			  cntr.appendChild(runner);
			  this.runners.push(runner);
			  this.update(page);
			  return cntr;
			},
			update: function (page) {
			  var place = reader1.getPlace(page);
			  //reader1.getPlace().percentageThrough()
			  this.runners[page.pageIndex].innerHTML = place.pageNumber();
			}
		      }
		      reader1.addControl(pageNumber, 'page');
		      reader1.addListener(
			'monocle:pagechange',
			function (evt) { pageNumber.update(evt.monocleData.page) }
		      );









			  reader1.addControl(scrubber, 'page', { hidden: true });
			  var showFn = function (evt) {
				evt.stopPropagation();
				reader1.showControl(scrubber);
				scrubber.updateNeedles();
			  }
			  var eType = (typeof(Touch) == "object" ? "touchstart" : "mousedown");
			  for (var i = 0; i < chapterTitle.runners.length; ++i) {
				Monocle.addListener(chapterTitle.runners[i].parentNode, eType, showFn);
				Monocle.addListener(pageNumber.runners[i].parentNode, eType, showFn);
			  }
		      	  var hideScrubber = function (evt) {
				evt.stopPropagation();
				reader1.hideControl(scrubber);
		      	  }
			  reader1.addListener('monocle:contact:start', hideScrubber);



			  var lastPlace = placeSaver.savedPlace();
			  if (lastPlace) {
			    placeSaver.restorePlace();
			  }
			}
		      );
		})();
		</script>







































    <div id="readerBg">
      <div class="board"></div>
      <div class="jacket"></div>
      <div class="dummyPage"></div>
      <div class="dummyPage"></div>
      <div class="dummyPage"></div>
    </div>

    <div id="readerCntr">
      <div id="placesaver"></div>
    </div>




<?php



$navigator="";
$navigator.="<a href=\"#\" onClick=\"window.PAPERFRAME.reader1.moveTo({ page: window.PAPERFRAME.reader1.getPlace().pageNumber()-1 });\">Zur&uuml;ckblättern</a>  | ";
$navigator.="<a href=\"#\" onClick=\"window.PAPERFRAME.reader1.moveTo({ page: window.PAPERFRAME.reader1.getPlace().pageNumber()+1 });\">Vorblättern</a><br />";
// Buch lesen
$navigator.="<a href=\"#\" onClick=\"translateSelection()\">Wort &uuml;bersetzen</a>";

if($_SESSION["username"]!="anonymous")
	$navigator.=" |  <a href=\"#\" onClick=\"noteSelection()\">Notieren</a>";


$helpEbookReaderIntegrated="<div id='applicationInfoDockHelp'>";
$helpEbookReaderIntegrated.="<strong>Seiten umblättern</strong><ul><li>Mausklick auf rechten/linken Bereich der Buchseite</li><li>Klicken und Ziehen auf der Seite</li><li>Pfeil(Cursor)-Tasten rechts/links</li><li>siehe Hyperlinks unten zum Vor- und Zurückblättern</li></ul>";
$helpEbookReaderIntegrated.="<p><strong>Kapitelübersicht</strong>: Klicken Sie auf den Buchtitel links oben im Lesebereich.</p>";
$helpEbookReaderIntegrated.="<p><strong>Schnellnavigation</strong>: Klicken Sie die Seitenzahl rechts, um den Blätterbalken anzuzeigen und verwenden Sie den Scrollknopf, in dem sie ihn anklicken und nach links oder rechts ziehen.</p>";
$helpEbookReaderIntegrated.="<p><strong>Lesezeichen</strong>: Das Leseprogramm merkt sich automatisch die Leseposition. Sie können im Anwendungsmenü aktiv beliebig viele Lesezeichen setzen und aufrufen.</p>";
$helpEbookReaderIntegrated.="</div>";

?>


<script type="text/javascript">





var menuRating;
var tp;
parent.dojo.addOnLoad(function() {


	
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
	    title: "Bewertung",
	    content: "<div id='MyLeftPaneInfoRating'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
	tp = new parent.dijit.TitlePane({
	    title: "Buchnavigation",
	    content: "<div id='MyLeftPaneReadingNav'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);




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
parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";







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
/*
// we don't speak in this mode until we don't know how to retrieve html-content for viewport
if(!isset($_GET["addremovebookmark"]) && !isset($_GET["besilent"])) {
?>
parent.READINGFRAME.location.href="readAloud.txtReader.php?<?php echo SID;?>&rand=<?php echo rand(0,100000000);?>";
<?php } 
*/
?>
//-->
</script>


