<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true">
</script>
<script type="text/javascript">
dojo.require("dijit.form.Form");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.DateTextBox");
dojo.require("dojox.validate.regexp");
</script>


		<link rel="STYLESHEET" type="text/css" href="includes/dhtmlxgrid/dhtmlxgrid.css">
		<link rel="stylesheet" type="text/css" href="includes/dhtmlxgrid/skins/dhtmlxgrid_dhx_skyblue.css">
		<script src="includes/dhtmlxgrid/dhtmlxcommon.js"></script>
		<script src="includes/dhtmlxgrid/dhtmlxgrid.js"></script>        
		<script src="includes/dhtmlxgrid/dhtmlxgridcell.js"></script>
		<script src="includes/dhtmlxgrid/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>
		<?php 
		if($dhtmlxdatagriddebugger==true) {?>
		<script src="includes/dhtmlxgrid/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor_debug.js"></script>
		<?php
		}
		?>








           
            
<script>

function addRow(){
var newId = (new Date()).valueOf()
mygrid.addRow(newId,"",mygrid.getRowsNum())
mygrid.selectRow(mygrid.getRowIndex(newId),false,false,true);
}
function removeRow(){
var selId = mygrid.getSelectedId()
mygrid.deleteRow(selId);
}

winheight=window.innerHeight;
winwidth=window.innerWidth;
document.write("<div id='gridbox' style='position:relative;top:2px;width:"+(winwidth-30)+"px;height:"+(winheight-80)+"px;overflow:hidden'></div>");



//init grid and set its parameters (this part as always);
mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("includes/dhtmlxgrid/imgs/");
mygrid.setColumnIds("notes_id,notes_author,notes_bookname,note_content");
mygrid.setHeader("Autor,Buchtitel,Datum,Notiz");
mygrid.setInitWidths("130,140,80,*");
mygrid.setColAlign("left,left,left,left");
//mygrid.setColAlign("center,left,center,center");
mygrid.setColTypes("ed,ed,ed,txt");
//mygrid.setColTypes("dyn,ed,txt,price,ch,coro,ch,ro");
mygrid.setSkin("dhx_skyblue");
//mygrid.setColSorting("int,str,str,int,str,str,str,date");
mygrid.setColSorting("str,str,date,str");
mygrid.init();
mygrid.loadXML("includes/dhtmlxgrid/php/notes.get.php?<?php echo SID; ?>");
//used just for demo purposes;
//============================================================================================;
myDataProcessor = new dataProcessor("includes/dhtmlxgrid/php/notes.update.php?<?php echo SID; ?>");
//lock feed url;
myDataProcessor.setDataColumns([true, true, true, true]);
//myDataProcessor.enablePartialDataSend(true);
//only second and third columns will trigger data update;
myDataProcessor.init(mygrid);
//link dataprocessor to the grid;
//============================================================================================;

</script>

 <button dojoType="dijit.form.Button" type="submit" name="btnLogin"
            value="Submit" onClick="addRow()">
                Notiz hinzufügen
            </button>
 <button dojoType="dijit.form.Button" type="submit" name="btnLogin"
            value="Submit" onClick="removeRow()">
                Notiz entfernen
            </button>


<?php

$helpEbookReaderIntegrated="";
$helpEbookReaderIntegrated.="Hier findest Du alle vorhandenen Exzerptionsstellen und Notizen.<p></p>";
$helpEbookReaderIntegrated.="";

?>


<script type="text/javascript">
var tp;
parent.dojo.addOnLoad(function() {
	parent.document.getElementById("paneLeftInfoPane").innerHTML="";
	tp = new parent.dijit.TitlePane({
	    title: "Alle Exzerpte",
	    content: "<div id='MyLeftPaneInfoReader'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
});

	parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";

</script>

