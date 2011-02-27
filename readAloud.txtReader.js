

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
			if(parent.appReaderType==2) {
				if(parent.PAPERFRAME.acceptlinkforth==true) {
					parent.PAPERFRAME.location.href=parent.PAPERFRAME.htmllinkforth;
					parent.PAPERFRAME.focus();

				}
			}
			if(parent.appReaderType==0) {
				parent.PAPERFRAME.reader1.moveTo({ page: parent.PAPERFRAME.reader1.getPlace().pageNumber()+1 });
			}

		break;
		case 37: // Pfeil links
			if(parent.appReaderType==2) {
	 			if(parent.PAPERFRAME.acceptlinkback==true) {
					parent.PAPERFRAME.location.href=parent.PAPERFRAME.htmllinkback;
					parent.PAPERFRAME.focus();
				}	
			}
			if(parent.appReaderType==0) {
				parent.PAPERFRAME.reader1.moveTo({ page: parent.PAPERFRAME.reader1.getPlace().pageNumber()-1 });
			}
		break;
	}

}



