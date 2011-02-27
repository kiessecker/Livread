<?php
# Individually load dojo on need 
?>
<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true">
</script>
<script type="text/javascript">
dojo.require("dijit.form.Form");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.DateTextBox");

function validateLogin() {
	if(document.getElementById("txtUserId").value=="" || document.getElementById("txtPassword").value=="") {
	parent.renderSimpleDialog("Fehler bei der Anmeldung","Eingabe","Bitte geben Sie ihren Benutzernamen und ihr Passwort ein. Falls Sie noch keinen Benutzernamen haben, klicken Sie bitte auf 'Registrieren'.");
		
	}

}

</script>

<?php 

if(isset($_GET["approvalInfo"])) {
?>
<script type="text/javascript">
	parent.renderSimpleDialog("Registrierung erfolgreich!","Ihr Handeln ist notwendig","Ihr Zugang bei Livread wurde erfolgreich erstellt. Wir haben Ihnen eine eMail mit Ihren Personendaten und einem Aktivierungslink zugesandt. Dieser Aktivierungslink ist erforderlich, um Ihren Zugang freizuschalten. Sobald Sie den Aktivierungslink in der eMail angeklickt haben, können Sie sich mit Ihren Zugangsdaten bei Livread anmelden.");
</script>

<?php
}


if(isset($livreadVarAccountActivated)) {
?>
<script type="text/javascript">
	parent.renderSimpleDialog("Aktivierung erfolgreich!","Hinweis","Die Aktivierung war erfolgreich, Sie können sich nun mit Ihren Zugangsdaten bei Livread anmelden.");
</script>

<?php
}

?>

<table width="700" border="0" cellpadding="5" cellspacing="5">
<tr>
	<td valign="top">
<div style="width:380px; height:190px;"><img src="img/login_logo.png" border="0" /></div>


<?php 
if (@$errorMessage != '') {

	echo "<p align=\"center\"><strong><font color=\"#990000\">&nbsp;".$errorMessage."</font></strong></p>"; 
}
?>


<div dojoType="dijit.form.Form" id="myFormTwo" jsId="myFormTwo" encType="multipart/form-data"
        action="index.application.php" method="post">
<table border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td colspan="2"><h1><?php echo UNIQUEAPPNAME_IN_APPLICATION;?> Anmeldung<h1></td>
</tr>
<tr>
<td width="150">Benutzername</td>
<td><input name="txtUserId" type="text" id="txtUserId" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte geben Sie ihren Benutzernamen ein." /></td>
</tr>
<tr>
<td width="150">Passwort</td>
<td>
<input name="txtPassword" type="password" id="txtPassword" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte geben Sie das Passwort ein." /></td>
</tr>
<tr>
<td width="150">&nbsp;</td>
<td>

 <button dojoType="dijit.form.Button" type="submit" name="submitButtonTwo"
            value="Submit" onClick="return validateLogin();">
                Anmelden
            </button>



</td>
</tr>
<tr>
<td width="150">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">Du hast noch kein Konto? <small><nobr>&#9655; &#9655; &#9655;</nobr></small> <a href="index.application.php?applicationAction=register&register=true">Registrieren</a></td>
</tr>
</table>
</div>


	</td>
	<td valign="top" width="40%">

		<img src="img/ci/livread9b_small.gif" border="0" />
		<div id="applicationInfoIntroRight"><br /></div>


	</td>
</tr>
</table>


<?php

$helpEbookReaderIntegrated="";
$helpEbookReaderIntegrated.="<strong>Funktionen</strong><ul><li>Greife von überall und mit jedem Gerät auf Deine eBook-Sammlung zu</li><li><em>Reading everywhere ...</em> - Mit Livread.com kannst Du auf beliebigen Geräten ganz einfach mit allen gängigen Browsern deine elektronischen Bücher lesen und verwalten.</li></ul>";
$helpEbookReaderIntegrated.="<p><strong>Komplette eBook-Reader-Anwendung wie auf Standalone-Geräten</strong>: <em>Mit dem Look-and-Feel eines richtigen eBook-Lesegerätes.</em></p>";
$helpEbookReaderIntegrated.="<p><strong>Livread unterstützt alle gängigen eBook-Formate</strong> wie epub, mobi, prc, fb2, txt, html, pdf,...</p>";
$helpEbookReaderIntegrated.="<p><strong>Komfortable und zentrale Verwaltung</strong> all deiner eBooks an einem Ort. Konvertiere Deine eBooks in verschiedene Formate.</p>";
$helpEbookReaderIntegrated.="<p><strong>Komfortable Textfunktionen</strong>. Livread.com bietet Dir Exzerpierfunktionen, um gelesenen Text schnell und effektiv zusammenzufassen, dies ist insbesondere für Studium und Beruf eine große Hilfe. Die Versioniermöglichkeiten von Dokumenten lassen keine Daten verloren gehen.</p>";
$helpEbookReaderIntegrated.="<p><strong>Anwendungsbeispiel</strong>. Greif' mit Deinen iPad / Netbook am Strand per WLAN auf Deine gesamte Bibliothek zu und lies Deine Bücher mit dem Look-and-Feel eines eBook-Readers.</p>";
$helpEbookReaderIntegrated.="<p><strong>Auf Wunsch</strong> bekommst Du die Möglichkeit, Dir Texte vorlesen zu lassen* </p><p>* dies ist ein kostenpflichtiger Service, da er viel Rechenzeit unseres Servers beansprucht</p>";
$helpEbookReaderIntegrated.="";

?>


<script type="text/javascript">
var tp;
parent.dojo.addOnLoad(function() {
	parent.document.getElementById("paneLeftInfoPane").innerHTML="";
	tp = new parent.dijit.TitlePane({
	    title: "<strong>Livread.com</strong> Dein online eBook-Lesegerät im Internet",
	    content: "<div id='applicationInfoIntroRightContainer'></div>"
	});
	document.getElementById("applicationInfoIntroRight").appendChild(tp.domNode);


/*
	var separatorElement=parent.document.createElement("div");
	separatorElement.innerHTML="<strong>Demo-Modus</strong><div id='MyLeftPaneInfoDemo'>Du kannst Livread ausprobieren, wähle dazu unter <em>Datei</em> &#9654; <em>Buch öffnen ...</em> ein Buch, das Du lesen möchtest ...</div>";
	separatorElement.style.padding="10px 10px 10px 10px";
*/
	tp = new parent.dijit.TitlePane({
	    title: "Registrieren",
	    content: "<div id='applicationInfoDockIntroInfo'>Livread ist kostenlos. <br />Wenn Du noch keinen Account hast <small><nobr>&#9655; &#9655; &#9655;</nobr></small> <a href='index.application.php?applicationAction=register&register=true' target='PAPERFRAME'>klicke hier</a>.</div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
	tp = new parent.dijit.TitlePane({
	    title: "Demo-Modus",
	    content: "<div id='MyLeftPaneInfoDemo'>Du kannst Livread ausprobieren, wähle dazu unter <em>Datei</em> &#9654; <em>Buch öffnen ...</em> ein Buch, das Du lesen möchtest ...</div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
//	parent.document.getElementById("paneLeftInfoPane").appendChild(separatorElement);
	tp = new parent.dijit.TitlePane({
	    title: "Quickie Demo",
	    content: "<div id='MyLeftPaneInfoDemo'><strong>Integrativer Reader:</strong> <a href='index.application.php?applicationAction=read&updateApplicationMenu=true&book=113' target='PAPERFRAME'>Siddhartha &mdash; Hermann Hesse</a> ... <br/><strong>Standalone Reader:</strong> <span style='font-size:75%'>Hinweis: klicken Sie auf den rechten/linken Blattbereich, um vor-/zurückzublättern</span><br /><a href='ebook.php?book=85' target='_top'>Bram Stokers Dracula (englisch)</a></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);

});

document.getElementById("applicationInfoIntroRightContainer").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";
document.getElementById("applicationInfoIntroRightContainer").style.height=""+(parent.applicationHeight-230)+"px";
</script>

