	<link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.css" />
	<link rel="stylesheet" type="text/css" href="js/dijit/themes/claro/claro.overrides.<?php echo $_SESSION["cssstyle"];?>.css" />

	<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true"></script>
	<script type="text/javascript">
	dojo.require("dijit.Menu");

	var pMenu;
	dojo.addOnLoad(function() {


//		pMenu.attr("contextMenuForWindow",true);

		pMenu = new dijit.Menu({
		    contextMenuForWindow: true,
		    onHide: function() {

			
			},
		    onFocus: function() {


		    }



		});

		pMenu.addChild(new dijit.MenuItem({
		    label: "Lesezeichen hinzufügen",
		    disabled: true
		}));

		pMenu.addChild(new dijit.MenuItem({
		    label: "Kopieren"
		}));
		pMenu.addChild(new dijit.MenuItem({
		    label: "Vorlesen lassen"
		}));
		pMenu.addChild(new dijit.MenuSeparator());
		pMenu.addChild(new dijit.MenuItem({
		    label: "Bibliothek",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    onClick: function() {
			alert('i was clicked')
		    }
		}));
		pMenu.addChild(new dijit.MenuItem({
		    label: "Buch hochladen",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    onClick: function() {
			alert('i was clicked')
		    }
		}));
		pMenu.addChild(new dijit.MenuSeparator());


		var pToolsMenu = new dijit.Menu();
		pToolsMenu.addChild(new dijit.MenuItem({
		    label: "Buch in MP3 konvertieren",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    onClick: function() {
			alert('i was clicked')
		    }
		}));
		pToolsMenu.addChild(new dijit.MenuItem({
		    label: "Übersetzen",
		    disabled: true
		}));
		pToolsMenu.addChild(new dijit.MenuItem({
		    label: "Notieren",
		    disabled: true
		}));


		pMenu.addChild(new dijit.PopupMenuItem({
		    label: "Werkzeuge",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    popup: pToolsMenu
		}));





		var pLangMenu = new dijit.Menu();
		pLangMenu.addChild(new dijit.CheckedMenuItem({
		    label: "Deutsch"
		}));
		pLangMenu.addChild(new dijit.MenuItem({
		    label: "Englisch"
		}));
		pLangMenu.addChild(new dijit.MenuItem({
		    label: "Spanisch"
		}));
		pLangMenu.addChild(new dijit.MenuItem({
		    label: "Französisch"
		}));
		pMenu.addChild(new dijit.PopupMenuItem({
		    label: "Sprache",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    popup: pLangMenu
		}));




		var pBookmarksOfBookMenu = new dijit.Menu();
		pBookmarksOfBookMenu.addChild(new dijit.MenuItem({
		    label: "Bei sooundsoo prozent (Entfernen)"
		}));
		pBookmarksOfBookMenu.addChild(new dijit.MenuItem({
		    label: "Bei sooundsoo prozent (Entfernen)"
		}));
		pBookmarksOfBookMenu.addChild(new dijit.MenuItem({
		    label: "Bei sooundsoo prozent (Entfernen)"
		}));
		pBookmarksOfBookMenu.addChild(new dijit.MenuItem({
		    label: "Bei sooundsoo prozent (Entfernen)"
		}));
		pMenu.addChild(new dijit.PopupMenuItem({
		    label: "Lesezeichen diesen Buches",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    popup: pBookmarksOfBookMenu
		}));



		var pBookmarkMenu = new dijit.Menu();
		pBookmarkMenu.addChild(new dijit.MenuItem({
		    label: "Buchsoundso sooundsoo prozent (Entfernen)"
		}));
		pBookmarkMenu.addChild(new dijit.MenuItem({
		    label: "Buchsoundso sooundsoo prozent (Entfernen)"
		}));
		pBookmarkMenu.addChild(new dijit.MenuItem({
		    label: "Buchsoundso sooundsoo prozent (Entfernen)"
		}));
		pBookmarkMenu.addChild(new dijit.MenuItem({
		    label: "Buchsoundso sooundsoo prozent (Entfernen)"
		}));
		pMenu.addChild(new dijit.PopupMenuItem({
		    label: "Letzte Bücher",
		    iconClass: "dijitEditorIcon dijitEditorIconCut",
		    popup: pBookmarkMenu
		}));





		var pSubMenu = new dijit.Menu();
		pSubMenu.addChild(new dijit.MenuItem({
		    label: "Notizen zeigen"
		}));
		pSubMenu.addChild(new dijit.MenuItem({
		    label: "Übersetzungen zeigen"
		}));
		pSubMenu.addChild(new dijit.MenuItem({
		    label: "Alle Lesezeichen zeigen"
		}));
		pMenu.addChild(new dijit.PopupMenuItem({
		    label: "Notationen",
		    popup: pSubMenu
		}));



		var pVoiceMenu = new dijit.Menu();
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Deutsch"
		}));
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Englisch male"
		}));
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Englisch male 2"
		}));
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Englisch male 3"
		}));
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Englisch female"
		}));
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Englisch female 2"
		}));
		pVoiceMenu.addChild(new dijit.MenuItem({
		    label: "Englisch female 3"
		}));
		pMenu.addChild(new dijit.PopupMenuItem({
		    label: "Vorlesestimmen",
		    popup: pVoiceMenu
		}));






		pMenu.startup();
	});

	</script>

