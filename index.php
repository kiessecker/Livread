<?php

header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");


# Browser Patching
require("includes/browserpatch.php");

# Get configuration loaded
require_once("config/config.php");

# Check country of client
include_once('includes/ip2country/ip2country.php');
$ip2c=new ip2country();
$ip2c->table_name='ip2c';


# Documentation:
# if we have DEBUG=true in config.php then we don't set iframes for ajax and reading to hidden place, instead
# we show it widely on the bottom of the page
#
#
#
#


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php 
$german=array("DE","AT","CH");

if(in_array($ip2c->get_country_code(),$german))
	echo "Livread Online eBook Lesegerät und Private Bibliothek";
else
	echo "Livread Online eBook Reader and Personal Online Library Management";
?></title>
		<meta name="keywords" content="eBook-Reader, Online Library, epub conversion, ebook, online ebook reader, private library, bookshelf" />
		<meta name="description" content="Online eBook Reader and Library Management." />


		<link rel="stylesheet" type="text/css" href="styles/index.css.php" />
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.css" />
		<style type="text/css">
		@import "/js/dojox/form/resources/Rating.css";
		</style>
		<!-- modifier -->
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.overrides.brown.css" title="theme.brown" />
	        <link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.overrides.green.css" title="theme.green" />
		<!-- favico -->
		<link rel="shortcut icon" href="favicon.ico" />
		<script src="index.js" type="text/javascript"></script>
		<script src="js/jquery.js" type="text/javascript"></script>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<?php /*<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true"></script>*/?>
		<script type="text/javascript" src="/specialdj/dojo/dojo.js" djConfig="parseOnLoad: true"></script>
		<script type="text/javascript">
		dojo.require("dijit.MenuBar");
		dojo.require("dijit.MenuBarItem");
		dojo.require("dijit.PopupMenuBarItem");
		dojo.require("dijit.Menu");
		dojo.require("dijit.MenuItem");
		dojo.require("dijit.PopupMenuItem");
	        dojo.require("dijit.form.Button");
		dojo.require("dijit.Dialog");
		dojo.require("dijit.layout.TabContainer");
		dojo.require("dijit.layout.ContentPane");
		dojo.require("dijit.layout.BorderContainer");
		dojo.require("dojox.layout.ExpandoPane");
	        dojo.require("dijit.TitlePane");
		dojo.require("dojox.form.Rating");



		dojo.addOnLoad(function() {
			// we are extending some object methods
			dojo.extend(dojox.layout.ExpandoPane,{
				_hideWrapper: function() {
					livreadJSCookieMethod("expandoframe_"+appCurrentActivity+"_activelyClosed",1);
					dojo.addClass(this.domNode,"dojoxExpandoClosed");
					dojo.style(this.cwrapper,{visibility:"hidden",opacity:"0",overflow:"hidden"});
				}
			});

			dojo.extend(dojox.layout.ExpandoPane,{
				_showEnd: function() {
					livreadJSCookieMethod("expandoframe_"+appCurrentActivity+"_activelyClosed",0);
					dojo.style(this.cwrapper,{opacity:0,visibility:"visible"});
					dojo.anim(this.cwrapper,{opacity:this._isonlypreview?this.previewOpacity:1},227);
					dojo.removeClass(this.domNode,"dojoxExpandoClosed");
					if(!this._isonlypreview) {
						setTimeout(dojo.hitch(this._container,"layout"),15);
					} else {
						this._previewShowing=true;
						this.resize();
					}
				}
			});






		});


		var preventCachingVar=0;
		function tryTime() {
			if(preventCachingVar==0) {
				window.PAPERFRAME.location.href="index.application.php";
				window.READINGFRAME.location.href="blank.php";
				window.AJAXFRAME.location.href="blank.php";
			}
			preventCachingVar=1;		
		}

		</script>
	</head>
	<body class=" claro " onLoad="calculatePane();">

		<!-- Dijit Dialog Frame -->
		<div id="dialogOne" dojoType="dijit.Dialog" title="Dialog"  onClick="dijit.byId('dialogOne').hide();">
		    <div id="dialogdivContainer" dojoType="dijit.layout.TabContainer" style="width: 300px; height: 300px;">
			<div id="dialogdiv" dojoType="dijit.layout.ContentPane" title="Dialog">
			</div>
		    </div>
		</div>

		<!-- Dijit Menubar -->
		<div id="applicationMenu">
		</div>


		<!-- Dijit Panes -->
	        <div dojoType="dijit.layout.BorderContainer" 
			design="sidebar" gutters="false" 
			liveSplitters="true" id="borderContainer">
            		<div id="paneInfodock" dojoType="dojox.layout.ExpandoPane" startExpanded="true"  
				title="Information" maxWidth="225"
				splitter="true" region="leading" style="width: 225px;">
			        <div id="paneLeftInfoPane"></div>
				<?php if(DEBUG_MODE!=true) { ?>
				<iframe src="blank.php" width="225" height="140" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" name="READINGFRAME"></iframe>
				<iframe src="blank.php" width="10" height="10" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" name="AJAXFRAME"></iframe> <?php
				} ?>
			</div>

			<div dojoType="dijit.layout.ContentPane" 
				splitter="true" region="center">
				<iframe id="paperIFrame" frameborder="0" marginwidth="0" 
					marginheight="0" 
					name="PAPERFRAME" 
					src="index.application.php" width="100%" onload="tryTime();">
				</iframe>
			</div>
		</div><?php if(DEBUG_MODE==true) { ?>
				<iframe src="blank.php" width="<?php echo DEBUGFRAMEWIDTH;?>" height="<?php echo DEBUGFRAMEHEIGHT;?>" frameborder="0" scrolling="yey" marginwidth="0" marginheight="0" name="READINGFRAME"></iframe>
				<iframe src="blank.php" width="<?php echo DEBUGFRAMEWIDTH;?>" height="<?php echo DEBUGFRAMEHEIGHT;?>" frameborder="0" scrolling="yes" marginwidth="0" marginheight="0" name="AJAXFRAME"></iframe> <?php
				} ?>

	</body>

</html>
