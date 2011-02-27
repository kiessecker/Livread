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


*/


		case 86: // V deselect
//			alert(reader1.getPlace().properties.component.innerHTML);

//	alert(reader1.getPlace().pageNumber());
//	a in reader1.getPlace().getLocus()
//	alert(reader1.getPlace().getLocus().componentId); -> gibt das HTML-Dokument aus ebookHTML/777/3.xml
//	alert(reader1.getPlace().componentId()); // dito?? glaub ja
//	alert(reader1.getPlace().getLocus().page); 	  -> gibt Seitennummer aus 2
// 	alert(reader1.getPlace().percentageThrough()); liefert z.B. 0.08

// reader.getPlace()-> Objects:	setPlace, setPercentageThrough, pageAtPercentageThrough, chapterInfo, chapterTitle 

// reader1.getPlace().properties.
//				component
//				percent
//				chapter
// 
// reader1.getPlace().properties.component.
// 				constructor constants properties applyTo updateDimensions lastPageNumber prepareNode chapterForPage pageForChapter


// reader. ==> constructor properties constants setBook getBook reapplyStyles getPlace moveTo skipToChapter resized addControl hideControl showControl dispatchEvent addListener

// reader.properties ==> divs controls pageWidth book interactionData resizeTimer flipper boxDimensions
//alert(reader1.getPlace().properties.component);
			str="";
/*

			for (a in reader1.properties.flipper) {
				str+=" "+a;
			}
			alert(str);
*/
			str="";
alert(reader1.properties.visiblePages+"xx");
			for (a in reader1.properties.visiblePages) {
				str+=" "+a;
			}
			alert(str);




//			v=document.body.innerHTML;
//			document.body.innerHTML="<textarea>"+v+"</textarea>";
			
		break;


		case 39: // Pfeil rechts

//properties.flipprt.properties constants addPage visiblePages getPlace  
/*
alert(reader1.properties.flipper.properties.pageCount); //2
alert(reader1.properties.flipper.properties.activeIndex); // 1
alert(reader1.properties.flipper.properties.divs); // object.object
alert(reader1.properties.flipper.properties.turnData); // object.object
alert(reader1.properties.flipper.properties.reader); // object.object
*/
      


//			reader1.moveTo({ direction: 1 });
			reader1.moveTo({ page: reader1.getPlace().pageNumber()+1 });
		break;
		case 37: // Pfeil links
//			reader1.moveTo({ direction: -1 });
			reader1.moveTo({ page: reader1.getPlace().pageNumber()-1 });
		break;
	}

}




