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
		break;

		case 66: // B jump to books
		break;
		case 65: // A jump to Authors
		break;
		case 70: // F jump to Favourites (Bookmarks)
		break;

		case 188: //  Add/Remove Bookmark
		break;


		case 84: // T Tageszeitung
		break;


		case 89: // Y Add Highlight
		break;




		case 27: // ESC 
		break;




		case 86: // V deselect
				document.getElementById("clickBarNavi").focus();
		break;
*/


		case 39: // Pfeil rechts
			if(parent.appReaderType==2) {
				if(acceptlinkforth==true)
					document.location.href=htmllinkforth;
			}
			if(parent.appReaderType==0) {
				reader1.moveTo({ page: reader1.getPlace().pageNumber()+1 });
			}
		break;
		case 37: // Pfeil links
			if(parent.appReaderType==2) {
	 			if(acceptlinkback==true)
					document.location.href=htmllinkback;
			}
			if(parent.appReaderType==0) {
				reader1.moveTo({ page: reader1.getPlace().pageNumber()-1 });
			}
		break;
	}

}



