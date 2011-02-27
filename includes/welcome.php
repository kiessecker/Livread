<h1>Willkommen bei bei Livread.com</h1>
<p><strong>Hinweis:</strong><br />Du kannst Dir kostenlos über 100.000 Bücher im epub-Format auf <a href="http://www.gutenberg.org" target="_blank">Project Gutenberg</a> herunterladen.</p><p>Diese Bücher kannst Du auf Livread.com hochladen.</p>

 
<?php

$helpEbookReaderIntegrated="";
$helpEbookReaderIntegrated.="<p>Bitte verwende das Menü, um Bücher zu verwalten, oder, um Bücher zum Lesem aufzurufen.</p>";
$helpEbookReaderIntegrated.="";

?>


<script type="text/javascript">
var tp;
parent.dojo.addOnLoad(function() {
	parent.document.getElementById("paneLeftInfoPane").innerHTML="";
	tp = new parent.dijit.TitlePane({
	    title: "Herzlich willkommen",
	    content: "<div id='MyLeftPaneInfoReader'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
});

	parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";

</script>

