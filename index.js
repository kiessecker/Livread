var appProtection=true;
var appReaderType=0;
var appCurrentActivity=0;
var appCurrStylesheet="brown"; // the default stylesheet

// Belongs to reading, reset this, for certain operations (delete current book, versionize current book,...; and, if not null

var currentBookId=null;
var currentBookPage=null;
var currentBookAuthor=null;
var currentBookTitle=null;
var currentUsersBookmarks=new Array();


function livreadGotoBookmark(bookmarkBook,bookmarkPage,bookmarkComponent,doReload) {
	if(appReaderType==2) {
		if(doReload==1)
			window.PAPERFRAME.location.href="index.application.php?applicationAction=read&updateApplicationMenu=true&book="+bookmarkBook+"&page="+bookmarkPage;
		else
			window.PAPERFRAME.location.href="index.application.php?applicationAction=read&book="+bookmarkBook+"&page="+bookmarkPage;

	}
	if(appReaderType==0) {
		if(doReload==1) {
			window.PAPERFRAME.location.href="index.application.php?applicationAction=read&updateApplicationMenu=true&book="+bookmarkBook+"&page="+bookmarkPage;
		}
		window.PAPERFRAME.reader1.moveTo({ percent: bookmarkPage, componentId: bookmarkComponent });
	}
}





function switchBookmark() {
	if(currentBookId!=null) {
		livreadEbookComponent="";
		if(appReaderType==0) {
			currentBookPage=window.PAPERFRAME.reader1.getPlace().percentageThrough();
			livreadEbookComponent=window.PAPERFRAME.reader1.getPlace().componentId();
		}

// wir müssen auch noch componentId mitgeben, wenn reader 0 und mitspeichern und mitladen

//      window.PAPERFRAME.reader1.moveTo({ percent: 0.3, componentId: window.PAPERFRAME.reader1.getPlace().componentId() });

//      window.PAPERFRAME.reader1.moveTo({ percent: 0.9 });




//var addremovebookmarkurl="index.application.php?applicationAction=read&addremovebookmark=true&book=<?php echo $_GET["book"];?>&page=<?php echo $page;?>";
//var addremovebookmarkurl="index.php?addremovebookmark=true&book=<?php echo $_GET["book"]."&page=".$page;?>";
		window.AJAXFRAME.location.href="bookmark.addremove.php?book="+currentBookId+"&page="+currentBookPage+"&component="+escape(livreadEbookComponent);
	} else {
		renderSimpleDialog("Mitteilung","Lesezeichen setzen/entfernen nicht möglich","Sie haben momentan kein Buch geöffnet. Daher ist momentan das Setzen/Entfernen von Lesezeichen nicht möglich.");
	}
}




var zoomListeners = [];
var applicationHeight=0;
var applicationWidth=0;

(function(){
  // Poll the pixel width of the window; invoke zoom listeners
  // if the width has been changed.
  var lastWidth = 0;
  function pollZoomFireEvent() {
    var widthNow = jQuery(window).width();
    var heightNow = jQuery(window).height();
    applicationWidth=widthNow;
    applicationHeight=heightNow;
    if (lastWidth == widthNow) {
	return;
    } else {
//	alert("changed!"+applicationWidth+"width . "+applicationHeight+"height");
	calculatePane();
    }
    lastWidth = widthNow;
    // Length changed, user must have zoomed, invoke listeners.
    for (i = zoomListeners.length - 1; i >= 0; --i) {
      zoomListeners[i]();
    }
  }
  setInterval(pollZoomFireEvent, 400);
})();


function  calculatePane() {
	if(document.getElementById("applicationMenu")!=null) {
		var newBorderContainerHeight=applicationHeight-document.getElementById("applicationMenu").clientHeight-10;
		var newBorderContainerWidth=applicationWidth;
		document.getElementById("borderContainer").style.height=""+newBorderContainerHeight+"px";
		document.getElementById("borderContainer").style.width=""+newBorderContainerWidth+"px";

		document.getElementById("paperIFrame").style.height=""+(newBorderContainerHeight-40)+"px";
	}
}





function sendToAjaxFrame(url) {
	window.AJAXFRAME.location.href=url;
}

function sendToReadFrame(url) {
	window.READINGFRAME.location.href=url;
}



function noteSelection() {
    var transtxt = '';
     if (window.getSelection) {
        	transtxt = window.PAPERFRAME.getSelection();
     } else if (document.getSelection) {
		transtxt = window.PAPERFRAME.document.getSelection();
     } else if (document.selection) {
        	transtxt = window.PAPERFRAME.document.selection.createRange().text;
     } else return;
	if(transtxt=="") {

document.getElementById("dialogdiv").innerHTML="Bitte zuerst Text markieren<br /><br /><button id=\"buttonTwo\" dojoType=\"dijit.form.Button\" onClick=\"dijit.byId('dialogOne').hide();\" type=\"button\">Fortfahren</button>";
returnvar=renderDojoDialog("Meldung","Aktion nicht möglich",0);

	} else {
		window.AJAXFRAME.location.href = "note.php?passage="+escape(transtxt)+"&author="+escape(window.PAPERFRAME.notebookauthor)+"&title="+escape(window.PAPERFRAME.notebooktitle);
	}
//     alert(transtxt);
}





function copyToClipboard(s) {
	if( window.clipboardData && clipboardData.setData ) {
		clipboardData.setData("Text", s);
	} else {
		// You have to sign the code to enable this or allow the action in about:config by changing user_pref("signed.applets.codebase_principal_support", true);
		netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');

		var clip = Components.classes['@mozilla.org/widget/clipboard;[[[[1]]]]'].createInstance(Components.interfaces.nsIClipboard);
	   if (!clip) return;
	   
	   // create a transferable
	   var trans = Components.classes['@mozilla.org/widget/transferable;[[[[1]]]]'].createInstance(Components.interfaces.nsITransferable);
	   if (!trans) return;
	   
	   // specify the data we wish to handle. Plaintext in this case.
	   trans.addDataFlavor('text/unicode');
	   
	   // To get the data from the transferable we need two new objects
	   var str = new Object();
	   var len = new Object();
	   
	   var str = Components.classes["@mozilla.org/supports-string;[[[[1]]]]"].createInstance(Components.interfaces.nsISupportsString);
	   
	   var copytext=meintext;
	   
	   str.data=copytext;
	   
	   trans.setTransferData("text/unicode",str,copytext.length*[[[[2]]]]);
	   
	   var clipid=Components.interfaces.nsIClipboard;
	   
	   if (!clip) return false;
	   
	   clip.setData(trans,null,clipid.kGlobalClipboard);	   
	}
}



function renderDojoTranslationDialog() {
	var newBorderContainerHeight=document.getElementById("borderContainer").clientHeight-document.getElementById("applicationMenu").clientHeight-60;
	var newBorderContainerWidth=document.getElementById("borderContainer").clientWidth-90;
	document.getElementById("dialogdivContainer").style.height=""+newBorderContainerHeight+"px";
	document.getElementById("dialogdivContainer").style.width=""+newBorderContainerWidth+"px";


	dijit.byId("dialogdiv").attr("title", "English-Deutsch");
	dijit.byId("dialogOne").attr("title", "&Uuml;bersetzung");
	dijit.byId("dialogOne").show();
}


function renderDojoDialog(infoBar,subBar,needsRelocation) {
	var newBorderContainerHeight=200;
	var newBorderContainerWidth=400;
	document.getElementById("dialogdivContainer").style.height=""+newBorderContainerHeight+"px";
	document.getElementById("dialogdivContainer").style.width=""+newBorderContainerWidth+"px";

	// Wheter it is simply information dialog or has to proceed to url defined in button action
	if(needsRelocation==1)
		dijit.byId("dialogOne").attr("onClick", "");
	else
		dijit.byId("dialogOne").attr("onClick", "dijit.byId('dialogOne').hide();");

	dijit.byId("dialogdiv").attr("title", subBar);
	dijit.byId("dialogOne").attr("title", infoBar);
	dijit.byId("dialogOne").show();
}

function copyrightInfo() {
logoXT="<img src='img/ci/livread9b_medium.gif' /><br />";
document.getElementById("dialogdiv").innerHTML="&copy;2010 by www.livread.com<br /><br />Kontakt: temp@livread.com<br /><div>"+logoXT+"</div><br /><br /><button id=\"buttonTwo\" dojoType=\"dijit.form.Button\" onClick=\"dijit.byId('dialogOne').hide();\" type=\"button\">Fenster schlie&szlig;en</button><br /><br />With Love and Appreciation!<br /><br />GOD, Thanks for being!";
returnvar=parent.renderDojoDialog("Information","Copyright-Hinweis",1);



}




function renderExtendedDialog(dialogtype,dialogtitle,dialogtext,targetFrame,urlLocation,onlyForward) {
	cancelActionButton="<button id=\"buttonTwo\" dojoType=\"dijit.form.Button\" onClick=\"dijit.byId('dialogOne').hide();\" type=\"button\">Abbrechen</button>";
	if(onlyForward!=false)
		cancelActionButton="";

	document.getElementById("dialogdiv").innerHTML=dialogtext+"<br /><br />"+cancelActionButton+"<button id=\"buttonOne\" dojoType=\"dijit.form.Button\" onClick=\"dijit.byId('dialogOne').hide();window."+targetFrame+".location.href='"+urlLocation+"';\" type=\"button\">Fortfahren</button>";
	returnvar=parent.renderDojoDialog(dialogtype,dialogtitle,0);
}


function renderSimpleDialog(dialogtype,dialogtitle,dialogtext) {
	document.getElementById("dialogdiv").innerHTML=dialogtext+"<br /><br /><button id=\"buttonTwo\" dojoType=\"dijit.form.Button\" onClick=\"dijit.byId('dialogOne').hide();\" type=\"button\">OK</button>";
	returnvar=parent.renderDojoDialog(dialogtype,dialogtitle,0);
}




function translateSelection() {
    var transtxt = '';
     if (window.getSelection) {
        	transtxt = window.PAPERFRAME.getSelection();
     } else if (document.getSelection) {
		transtxt = window.PAPERFRAME.document.getSelection();
     } else if (document.selection) {
        	transtxt = window.PAPERFRAME.document.selection.createRange().text;
     } else {
  return;
     }
//     alert(transtxt);
     window.AJAXFRAME.location.href = "translate.php?word="+escape(transtxt);   
}




document.onkeyup = KeyCheck;
function KeyCheck(e) {

	var KeyID = (window.event) ? event.keyCode : e.keyCode;


//	alert("xxx"+KeyID);

	switch(KeyID) {


/*
		case 88: // X
				noteSelection();
		break;

		case 89: // Y
				translateSelection();
		break;


		case 78: // N
				document.location.href=htmllinkbackM;
		break;
		case 77: // M

		break;

		case 69: // E jump to end
				document.location.href=htmllinkend;
		break;

		case 66: // B jump to books
			// wir muessen noch Menue einblenden
				document.getElementById("bookNameChooser").focus();
		break;
		case 65: // A jump to Authors
				document.getElementById("bookAuthorChooser").focus();
		break;
		case 70: // F jump to Favourites (Bookmarks)
			// wir muessen noch Menue einblenden

				document.getElementById("bookMarksChooser").focus();
		break;

		case 188: //  Add/Remove Bookmark
		break;


		case 84: // T Tageszeitung

		break;


		case 89: // Y Add Highlight
			document.location.href=addhighlighturl;
		break;




		case 27: // ESC (Layer wieder zumachen
				jkmegamenu.hidemanualmenu(e, 0);
		break;




		case 86: // V deselect
				document.getElementById("clickBarNavi").focus();
		break;
*/


		case 39: // Pfeil rechts
			if(appReaderType==2) {
				if(window.PAPERFRAME.acceptlinkforth==true) {
					window.PAPERFRAME.location.href=window.PAPERFRAME.htmllinkforth;
					window.PAPERFRAME.focus();

				}
			}
			if(parent.appReaderType==0) {
				window.PAPERFRAME.reader1.moveTo({ page: window.PAPERFRAME.reader1.getPlace().pageNumber()+1 });
			}

		break;
		case 37: // Pfeil links
			if(appReaderType==2) {
	 			if(window.PAPERFRAME.acceptlinkback==true) {
					window.PAPERFRAME.location.href=window.PAPERFRAME.htmllinkback;
					window.PAPERFRAME.focus();
				}	
			}
			if(appReaderType==0) {
				window.PAPERFRAME.reader1.moveTo({ page: window.PAPERFRAME.reader1.getPlace().pageNumber()-1 });
			}
		break;
	}

}


function livreadJSCookieMethod(cookieName,value) {
	//alert(cookieName+"="+value);
	var a = new Date();
	a = new Date(a.getTime() +1000*60*60*24*365);
	document.cookie = ''+cookieName+'='+value+'; expires='+ a.toGMTString()+';'; 
}



function changeActiveStyleSheet(newStylesheet) {
	if(appCurrStylesheet!=newStylesheet) {
		if(document.styleSheets) {
		var currentStyleSheetId=0;
			for(var StyleSheetIterator=0; StyleSheetIterator<document.styleSheets.length; StyleSheetIterator++) {
				currStyleSheet=document.styleSheets[StyleSheetIterator].title;
				if(currStyleSheet.search(/theme\./)!=-1) {
						document.styleSheets[StyleSheetIterator].disabled = true;
				}
				if(document.styleSheets[StyleSheetIterator].title == "theme."+newStylesheet) {
					currentStyleSheetId=StyleSheetIterator;
				}
			}
			appCurrStylesheet=newStylesheet;
			document.styleSheets[currentStyleSheetId].disabled = false;
		}
	}
}

