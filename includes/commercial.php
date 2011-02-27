<div id="commercialButtonContainer"></di>
<div id="commercial" style="position:absolute; top:1px; left:1px; overflow:hidden;width:1px; height:1px;visibility:hidden;">
	<div style="background:salmon; color:white;">
	Sie sind nicht angemeldet. Dies ist eine Demonstration. Wenn Sie diesen Service nutzen wollen, wenden Sie sich bitte an test@livread.com. Die Leistungen dieses Angebots sind:
	<ul>
		<li>Private/eigene eBook-Online-Biliothek</li>
		<li>Zugriff auf die persönliche Bibliothek von überall</li>
		<li>Lesen Sie Ihre Lieblingsbücher von jedem Gerät, beispielsweise am Strand über WLAN von einem Smartphone</li>
		<li>Versionsmanagement für eBooks</li>
		<li>Ermögliche Familienmitgliedern und Freunden den Zugriff auf die eigene Bibliothek</li>
		<li>Sprachausgabe in Deutsch und Englisch. Lassen Sie sich Ihre Bücher und Texte ganz bequem vorlesen</li>
		<li>Leistungsfähige Konvertierungen zwischen verschiedenen eBook-Formaten. Livread liest verschiedenste eBook-Formate, z.B. .oeb, .mobi, .rtf, .lit, .fb2, .html, .pdf, .epub, .txt (utf-8)
		<li>Insbesondere für Pflegepersonal von alten und behinderten Menschen geeignet zur Auswahl und zum Vorlesen. Maßgeschneiderte Anpassungen auf Wunsch.</li>
	</ul>

	</div>
</div>





    <script type="text/javascript">
        var secondDlg;
        parent.dojo.addOnLoad(function() {
            // create the dialog:
            secondDlg = new parent.dijit.Dialog({
                title: "Hinweise zur Benutzung",
                style: "width: 60%"
            });


        });





        function showDialogCommercial() {
            // set the content of the dialog:
	    var commercialText=document.getElementById("commercial").innerHTML;
            secondDlg.attr("content", commercialText);
            secondDlg.show();
        }
    </script>




        <script type="text/javascript">

		var button1 = new parent.dijit.form.Button({
			label: "Demo-Modus", 
                        onClick: function() {
				showDialogCommercial();
	                    }            
		});
		document.getElementById("commercialButtonContainer").appendChild(button1.domNode);


<?php if($applicationAction=="read") { ?>
		var button2 = new parent.dijit.form.Button({
			label: "Pfeil-Rechts/Links-Taste zum Vor/Zurückblättern", 
                        onClick: function() {
				showDialogCommercial();
	                    }            
		});
		document.getElementById("commercialButtonContainer").appendChild(button2.domNode);
<?php } ?>

        </script>








