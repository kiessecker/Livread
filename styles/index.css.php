<?php
	require_once("../config/config.php");
	header('Content-type: text/css');
?>

BODY, H1, H2, H3, P, DIV, SPAN {
	font-family:verdana, helvetica;
}

BODY { margin: 0px 0px 0px 0px; 

	  background-color: #FCF6F0;

	  -webkit-box-shadow: 2px 2px 4px #754;
	  -webkit-border-top-left-radius: 26px 6px;
	  -webkit-border-bottom-left-radius: 26px 6px;
	  -moz-border-radius-topleft: 26px 6px;
	  -moz-border-radius-bottomleft: 26px 6px;



}


.SelectEditionInfo { font-size:50%; font-style:italic; }
.SelectTable {
border: 1px solid black; padding:3px;
}


.SelectionHowto { font-size:50%; background:silver; border:1px gray; padding:2px 2px 2px 2px; margin-bottom:5px; 
}

.SelectionTitle0 {cursor:pointer; padding-left:3px; padding-right:3px; }
.SelectionTitle1 { background:#cccccc; cursor:pointer;  padding-left:3px; padding-right:3px; }


.SelectionPrefixTD {
	background-color:#777777;

}

.SelectionPreviewPopup { 
	padding:0px 0px 0px 0px; 
	background:gray;
	text-align: center; 
	border: 3px dotted black; 
	background: white; 
}


A.ssmItems:link		{color:black;text-decoration:none;}
A.ssmItems:hover	{color:black;text-decoration:none;}
A.ssmItems:active	{color:black;text-decoration:none;}
A.ssmItems:visited	{color:black;text-decoration:none;}




.authorselectbox {
	width:580px; font-size:16px;
}

.bookselectbox {
	width:580px; font-size:16px;
}



.bookmarkselectbox {
	width:580px; font-size:16px;
}


.copyBoxContainer {
	margin: 0px 0px 0px 0px; 
	overflow:hidden;
	width:58px; height:10px; 
	
}


.copycontentcontainer {
width:10px;overflow:hidden;z-index:100;position:absolute;top:0px;left:0px;
}




.translationframe {
position:absolute;
visibility:hidden;
left:5px;
top:30px;
overflow:auto;
height:0;
width:0;
background: white;
border: 1px solid #f06b24;
border-width: 5px 1px;
padding: 10px;
z-index: 100;
}





























/* needed by contentpane */

	
	.dojoxExpandoPane {
		overflow:hidden;
		z-index:440 !important;
	}
	
	.dojoxExpandoPane .dojoxExpandoWrapper {
		overflow:hidden;
	}
	.dojoxExpandoClosed .dojoxExpandoTitleNode {
		display:none;
	}
	
	.dojoxExpandoClosed .dojoxExpandoWrapper * {
		overflow:hidden !important;
	}
	.dojoxExpandoTitleNode {
		padding-right:6px; 
		padding-left:6px;
	}
	.dojoxExpandoIcon .a11yNode {
		display:none;
		visibility:hidden;
	}
	.dojoxExpandoBottom .dojoxExpandoIcon,
	.dojoxExpandoTop .dojoxExpandoIcon,
	.dojoxExpandoLeft .dojoxExpandoIcon {
		float:right;
		margin-right:2px;
	}
	.dojoxExpandoRight .dojoxExpandoIcon {
		float:left;
		margin-left:2px;
	}
	.dojoxExpandoIcon {
		width:14px;
		cursor:pointer;
		background-position:-60px 0px;
		background-repeat: no-repeat;
		height:14px;
	}
	.dojoxExpandoClosed .dojoxExpandoIcon {
		background-position: 0px 0px;
		margin:0 auto;
	}
	
	.dijitBorderContainer-dijitExpandoPane {
		border: none !important; 
	}
	
	.soria .dojoxExpandoTitle {
		height:16px;
		font-size:0.9em;
		font-weight:bold;
		padding:3px;
		padding-top:6px;
		padding-bottom:5px;
		background:#F0F4FC url("/js/dijit/themes/soria/images/tabContainerSprite.gif") repeat-x scroll 0pt -50px;
		border-left: 1px solid #B1BADF;
		border-right: 1px solid #B1BADF;
	}
	
	.soria .dojoxExpandoClosed .dojoxExpandoTitle {
		background: none;
		background-color: #F0F4FC;
		border: none;
	}
	
	.soria .dojoxExpandoClosed {
		background: none;
		background-color: #F0F4FC;
		border: 1px solid #B1BADF !important;
	}
	
	.soria .dojoxExpandoIcon {
		background-image: url('/js/dijit/themes/soria/images/spriteRoundedIconsSmall.png');
	}
	
	.dj_ie6 .soria .dojoxExpandoIcon {
		background-image: url('/js/dijit/themes/soria/images/spriteRoundedIconsSmall.gif');
	}
		
	
	.tundra .dojoxExpandoTitle {
		font-weight: bold;
		padding: 5px;
		padding-top: 6px;
		padding-bottom: 6px;
		background: #fafafa url("/js/dijit/themes/tundra/images/accordionItemActive.gif") repeat-x scroll left top;
		border-top: 1px solid #ccc;
		border-left: 1px solid #ccc;
		border-right: 1px solid #ccc;
	}
		
	.tundra .dojoxExpandoClosed .dojoxExpandoTitle {
		background: none;
		background-color: #fafafa;
		border: none;
		padding:3px;
	}
	
	.tundra .dojoxExpandoClosed {
		background: none;
		background-color: #fafafa;
		border: 1px solid #ccc !important;
	}
	.tundra .dojoxExpandoRight .dojoxExpandoTitle,
	.tundra .dojoxExpandoLeft .dojoxExpandoTitle,
	.tundra .dojoxExpandoClosed .dojoxExpandoTitle,
	.tundra .dojoxExpandoClosed {
		background-color: #fafafa;
	}
	
	.tundra .dojoxExpandoIcon {
		background-image: url('/js/dijit/themes/tundra/images/spriteRoundedIconsSmall.gif');
	}
	
	.tundra .dojoxExpandoClosed .dojoxExpandoIconLeft,
	.tundra .dojoxExpandoClosed .dojoxExpandoIconRight,
	.tundra .dojoxExpandoClosed .dojoxExpandoIconTop,
	.tundra .dojoxExpandoClosed .dojoxExpandoIconBottom {
		margin-top: 3px;
	}
	
	
	.claro .dojoxExpandoTitle {
		font-weight: bold;
		border:1px solid #769DC0;
		border-bottom:none;
        background-color:#cde8ff;
		background-image: url("/js/dijit/themes/claro/layout/images/accordion.png");
        background-position:0px 0px;
        background-repeat:repeat-x;
		padding: 5px 7px 2px 7px;
        min-height:17px;
        color:#4a4a4a;
	}
		
	.claro .dojoxExpandoClosed .dojoxExpandoTitle {
		background: none;
		background-color: #E6E6E7;
		border: none;
		padding:3px;
	}
	
	.claro .dojoxExpandoClosed {
		background: none;
		background-color: #E6E6E7;
		border: 1px solid #769DC0 !important;
	}
	.claro .dojoxExpandoRight .dojoxExpandoTitle,
	.claro .dojoxExpandoLeft .dojoxExpandoTitle,
	.claro .dojoxExpandoClosed .dojoxExpandoTitle{
		background-color: #E6E6E7;
	}
	.claro .dojoxExpandoClosed .dojoxExpandoTitle{
		background-image: url("/js/dijit/themes/claro/layout/images/accordion.png");
		background-position:0 0;
	}
	
	
	.claro .dojoxExpandoIcon {
		background-image: url('/js/dijit/themes/tundra/images/spriteRoundedIconsSmall.gif');
	}
	
	.claro .dojoxExpandoClosed .dojoxExpandoIconLeft,
	.claro .dojoxExpandoClosed .dojoxExpandoIconRight,
	.claro .dojoxExpandoClosed .dojoxExpandoIconTop,
	.claro .dojoxExpandoClosed .dojoxExpandoIconBottom {
		margin-top: 3px;
	}
	
	
	.nihilo .dojoxExpandoPane {
		background: #fafafa;
	}
	
	.nihilo .dojoxExpandoTitle {
		height:16px;
		font-size:0.9em;
		font-weight:bold;
		padding:3px;
		padding-top:6px;
		padding-bottom:5px;
		background:#fafafa url("/js/dijit/themes/nihilo/images/tabContainerSprite.gif") repeat-x scroll 0pt -50px;
		border-left: 1px solid #ccc;
		border-right: 1px solid #ccc;
	}
	
	.nihilo .dojoxExpandoClosed .dojoxExpandoTitle {
		background: none;
		background-color: #fafafa;
		border: none;
	}
	
	.nihilo .dojoxExpandoClosed {
		background: none;
		background-color: #fafafa;
		border: 1px solid #ccc !important;
	}
	
	.nihilo .dojoxExpandoIcon {
		background-image: url('/js/dijit/themes/nihilo/images/spriteRoundedIconsSmall.png');
	}
	
	.dj_ie6 .nihilo .dojoxExpandoIcon {
		background-image: url('/js/dijit/themes/nihilo/images/spriteRoundedIconsSmall.gif');
	}
		
	.nihilo .dojoxExpandoTop {
		border-bottom:1px solid #ccc;
		border-left:1px solid #ccc;
		border-right:1px solid #ccc; 
	}
	
	
	
	.dojoxExpandoClosed .dojoxExpandoIcon {
		margin-right:4px;
	}
	.dojoxExpandoIconLeft {
	  background-position: 0 0;
	}
	.dojoxExpandoClosed .dojoxExpandoIconLeft {
	  background-position: -30px 0;
		margin-right: 4px;
	}
	.dojoxExpandoIconRight {
	  background-position: -30px 0;
	}
	.dojoxExpandoClosed .dojoxExpandoIconRight {
	  background-position: 0 0;
		margin-left: 4px;
	}
	.dojoxExpandoIconBottom {
	  background-position: -15px 0;
	}
	.dojoxExpandoClosed .dojoxExpandoIconBottom {
	  background-position: -45px 0;
		margin-top:1px;
	}
	.dojoxExpandoIconTop {
	  background-position: -45px 0;
	}
	.dojoxExpandoClosed .dojoxExpandoIconTop {
	  background-position: -15px 0;
	}






H1 { font-size:12px; font-weight:bold; }
H2 { font-size:12px; font-weight:normal; }

html, body { width: 100%; height: 100%; margin: 0; } #borderContainer {
width: 100%; height: 100%; }

#applicationInfoDockHelp { margin:0px 0px 0px 0px; height:200px; font-size:80%; overflow:auto; }
#applicationInfoDockHelp > ul { padding:0px 0px 0px 6px; margin:0px 0px 0px 6px; }

/* font-size inhomogen, Neubetrachtung erforderlich */
#applicationInfoDockIntroInfo { font-size:80%; }
#applicationInfoDockIntroInfo > ul { padding:0px 0px 0px 6px; margin:0px 0px 0px 6px; }


