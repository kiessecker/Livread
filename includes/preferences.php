<?php

echo "TODO, see file, check that other form fields run over and update"; exit;

include_once('includes/ip2country/ip2country.php');

$ip2c=new ip2country();
$ip2c->table_name='ip2c';

//echo 'Your country name is '. $ip2c->get_country_name() . '<br>';
//echo 'Your country code is ' . $ip2c->get_country_code();

$countries=array("AF"=>"Afghanistan",
"AX"=>"ÅLand Islands",
"AL"=>"Albania",
"DZ"=>"Algeria",
"AS"=>"American Samoa",
"AD"=>"Andorra",
"AO"=>"Angola",
"AI"=>"Anguilla",
"AQ"=>"Antarctica",
"AG"=>"Antigua And Barbuda",
"AR"=>"Argentina",
"AM"=>"Armenia",
"AW"=>"Aruba",
"AU"=>"Australia",
"AT"=>"Austria",
"AZ"=>"Azerbaijan",
"BS"=>"Bahamas",
"BH"=>"Bahrain",
"BD"=>"Bangladesh",
"BB"=>"Barbados",
"BY"=>"Belarus",
"BE"=>"Belgium",
"BZ"=>"Belize",
"BJ"=>"Benin",
"BM"=>"Bermuda",
"BT"=>"Bhutan",
"BO"=>"Bolivia",
"BA"=>"Bosnia And Herzegovina",
"BW"=>"Botswana",
"BV"=>"Bouvet Island",
"BR"=>"Brazil",
"IO"=>"British Indian Ocean Territory",
"BN"=>"Brunei Darussalam",
"BG"=>"Bulgaria",
"BF"=>"Burkina Faso",
"BI"=>"Burundi",
"KH"=>"Cambodia",
"CM"=>"Cameroon",
"CA"=>"Canada",
"CV"=>"Cape Verde",
"KY"=>"Cayman Islands",
"CF"=>"Central African Republic",
"TD"=>"Chad",
"CL"=>"Chile",
"CN"=>"China",
"CX"=>"Christmas Island",
"CC"=>"Cocos (Keeling) Islands",
"CO"=>"Colombia",
"KM"=>"Comoros",
"CG"=>"Congo",
"CD"=>"Congo, The Democratic Republic Of The",
"CK"=>"Cook Islands",
"CR"=>"Costa Rica",
"CI"=>"Cote D'Ivoire",
"HR"=>"Croatia",
"CU"=>"Cuba",
"CY"=>"Cyprus",
"CZ"=>"Czech Republic",
"DK"=>"Denmark",
"DE"=>"Deutschland",
"DJ"=>"Djibouti",
"DM"=>"Dominica",
"DO"=>"Dominican Republic",
"EC"=>"Ecuador",
"EG"=>"Egypt",
"SV"=>"El Salvador",
"GQ"=>"Equatorial Guinea",
"ER"=>"Eritrea",
"EE"=>"Estonia",
"ET"=>"Ethiopia",
"FK"=>"Falkland Islands (Malvinas)",
"FO"=>"Faroe Islands",
"FJ"=>"Fiji",
"FI"=>"Finland",
"FR"=>"France",
"GF"=>"French Guiana",
"PF"=>"French Polynesia",
"TF"=>"French Southern Territories",
"GA"=>"Gabon",
"GM"=>"Gambia",
"GE"=>"Georgia",
"DE"=>"Deutschland",
"GH"=>"Ghana",
"GI"=>"Gibraltar",
"GR"=>"Greece",
"GL"=>"Greenland",
"GD"=>"Grenada",
"GP"=>"Guadeloupe",
"GU"=>"Guam",
"GT"=>"Guatemala",
" Gg"=>"Guernsey",
"GN"=>"Guinea",
"GW"=>"Guinea-Bissau",
"GY"=>"Guyana",
"HT"=>"Haiti",
"HM"=>"Heard Island And Mcdonald Islands",
"VA"=>"Holy See (Vatican City State)",
"HN"=>"Honduras",
"HK"=>"Hong Kong",
"HU"=>"Hungary",
"IS"=>"Iceland",
"IN"=>"India",
"ID"=>"Indonesia",
"IR"=>"Iran, Islamic Republic Of",
"IQ"=>"Iraq",
"IE"=>"Ireland",
"IM"=>"Isle Of Man",
"IL"=>"Israel",
"IT"=>"Italy",
"JM"=>"Jamaica",
"JP"=>"Japan",
"JE"=>"Jersey",
"JO"=>"Jordan",
"KZ"=>"Kazakhstan",
"KE"=>"Kenya",
"KI"=>"Kiribati",
"KP"=>"Korea, Democratic People'S Republic Of",
"KR"=>"Korea, Republic Of",
"KW"=>"Kuwait",
"KG"=>"Kyrgyzstan",
"LA"=>"Lao People'S Democratic Republic",
"LV"=>"Latvia",
"LB"=>"Lebanon",
"LS"=>"Lesotho",
"LR"=>"Liberia",
"LY"=>"Libyan Arab Jamahiriya",
"LI"=>"Liechtenstein",
"LT"=>"Lithuania",
"LU"=>"Luxembourg",
"MO"=>"Macao",
"MK"=>"Macedonia, The Former Yugoslav Republic Of",
"MG"=>"Madagascar",
"MW"=>"Malawi",
"MY"=>"Malaysia",
"MV"=>"Maldives",
"ML"=>"Mali",
"MT"=>"Malta",
"MH"=>"Marshall Islands",
"MQ"=>"Martinique",
"MR"=>"Mauritania",
"MU"=>"Mauritius",
"YT"=>"Mayotte",
"MX"=>"Mexico",
"FM"=>"Micronesia, Federated States Of",
"MD"=>"Moldova, Republic Of",
"MC"=>"Monaco",
"MN"=>"Mongolia",
"MS"=>"Montserrat",
"MA"=>"Morocco",
"MZ"=>"Mozambique",
"MM"=>"Myanmar",
"NA"=>"Namibia",
"NR"=>"Nauru",
"NP"=>"Nepal",
"NL"=>"Netherlands",
"AN"=>"Netherlands Antilles",
"NC"=>"New Caledonia",
"NZ"=>"New Zealand",
"NI"=>"Nicaragua",
"NE"=>"Niger",
"NG"=>"Nigeria",
"NU"=>"Niue",
"NF"=>"Norfolk Island",
"MP"=>"Northern Mariana Islands",
"NO"=>"Norway",
"OM"=>"Oman",
"PK"=>"Pakistan",
"PW"=>"Palau",
"PS"=>"Palestinian Territory, Occupied",
"PA"=>"Panama",
"PG"=>"Papua New Guinea",
"PY"=>"Paraguay",
"PE"=>"Peru",
"PH"=>"Philippines",
"PN"=>"Pitcairn",
"PL"=>"Poland",
"PT"=>"Portugal",
"PR"=>"Puerto Rico",
"QA"=>"Qatar",
"RE"=>"Reunion",
"RO"=>"Romania",
"RU"=>"Russian Federation",
"RW"=>"Rwanda",
"SH"=>"Saint Helena",
"KN"=>"Saint Kitts And Nevis",
"LC"=>"Saint Lucia",
"PM"=>"Saint Pierre And Miquelon",
"VC"=>"Saint Vincent And The Grenadines",
"WS"=>"Samoa",
"SM"=>"San Marino",
"ST"=>"Sao Tome And Principe",
"SA"=>"Saudi Arabia",
"SN"=>"Senegal",
"CS"=>"Serbia And Montenegro",
"SC"=>"Seychelles",
"SL"=>"Sierra Leone",
"SG"=>"Singapore",
"SK"=>"Slovakia",
"SI"=>"Slovenia",
"SB"=>"Solomon Islands",
"SO"=>"Somalia",
"ZA"=>"South Africa",
"GS"=>"South Georgia And The South Sandwich Islands",
"ES"=>"Spain",
"LK"=>"Sri Lanka",
"SD"=>"Sudan",
"SR"=>"Suriname",
"SJ"=>"Svalbard And Jan Mayen",
"SZ"=>"Swaziland",
"SE"=>"Sweden",
"CH"=>"Switzerland",
"SY"=>"Syrian Arab Republic",
"TW"=>"Taiwan, Province Of China",
"TJ"=>"Tajikistan",
"TZ"=>"Tanzania, United Republic Of",
"TH"=>"Thailand",
"TL"=>"Timor-Leste",
"TG"=>"Togo",
"TK"=>"Tokelau",
"TO"=>"Tonga",
"TT"=>"Trinidad And Tobago",
"TN"=>"Tunisia",
"TR"=>"Turkey",
"TM"=>"Turkmenistan",
"TC"=>"Turks And Caicos Islands",
"TV"=>"Tuvalu",
"UG"=>"Uganda",
"UA"=>"Ukraine",
"AE"=>"United Arab Emirates",
"GB"=>"United Kingdom",
"US"=>"United States",
"UM"=>"United States Minor Outlying Islands",
"UY"=>"Uruguay",
"UZ"=>"Uzbekistan",
"VU"=>"Vanuatu",
"VE"=>"Venezuela",
"VN"=>"Viet Nam",
"VG"=>"Virgin Islands, British",
"VI"=>"Virgin Islands, U.S.",
"WF"=>"Wallis And Futuna",
"EH"=>"Western Sahara",
"YE"=>"Yemen",
"ZM"=>"Zambia",
"ZW"=>"Zimbabwe");



# Individually load dojo on need 
?>
<script type="text/javascript" src="/js/dojo/dojo.js" djConfig="parseOnLoad: true">
</script>
<script type="text/javascript">
dojo.require("dijit.form.Form");
dojo.require("dijit.form.Button");
dojo.require("dijit.form.ValidationTextBox");
dojo.require("dijit.form.DateTextBox");
dojo.require("dojox.validate.regexp");
function validateLogin() {
	if(document.getElementById("txtUserId").value=="" || 
	   document.getElementById("txtPassword1").value=="" || 
	   document.getElementById("txtPassword2").value=="" || 

	   document.getElementById("txtFirstname").value=="" || 
	   document.getElementById("txtLastname").value=="" || 
	   document.getElementById("txtStreet").value=="" || 
	   document.getElementById("txtzip").value=="" || 
	   document.getElementById("txtcity").value=="" || 
	   document.getElementById("txtMail").value=="") {
	parent.renderSimpleDialog("Fehler bei der Registrierung","Eingabe","Bitte fülle alle Formularfelder aus.");
	} else {
		if(document.getElementById("txtMail").value!=document.getElementById("txtMail2").value) {
			parent.renderSimpleDialog("Fehler bei der Registrierung","eMail-Adress-Angabe","Du hast bei der eMail-Wiederholung eine andere eMail-Adresse eingegeben.");
		} else {
		if(document.getElementById("txtPassword1").value!=document.getElementById("txtPassword2").value) {
			parent.renderSimpleDialog("Fehler bei der Registrierung","Passwort-Eingabe","Passworteingabe und Wiederholung stimmen nicht überein.");
			}
		}
	}




}

</script>

<?php 
if (@$errorMessage != '') { ?>
<script type="text/javascript">
parent.renderSimpleDialog("Mitteilung","Fehler","<?php echo addslashes($errorMessage);?>");
</script>
<?php } ?>




<table width="700" border="0" cellpadding="5" cellspacing="5">
<tr>
	<td valign="top">





<div dojoType="dijit.form.Form" id="myFormTwo" jsId="myFormTwo" encType="multipart/form-data"
        action="index.application.php" method="post">

<table border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td colspan="3"><h1><?php echo UNIQUEAPPNAME;?> Einstellungen<h1></td>
</tr>
<tr>
<td width="150">Benutzername</td>
<td><?php echo $_SESSION["username"];?></td>
<td width="250">
</td>
</tr>
<tr>
<td width="150">Passwort</td>
<td>
<input name="txtPassword1" type="password" id="txtPassword1" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte gib ein beliebiges Passwort ein,<br />mit dem Du dich später anmelden möchtest." />
</td>
<td width="250">
</td>
</tr>
<tr>
<td width="150">Passwort wiederholen</td>
<td>
<input name="txtPassword2" type="password" id="txtPassword2" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte wiederhole das<br />eingegebene Passwort aus Sicherheitsgründen." />
</td>
<td width="250">
</td>
</tr>

<tr>
<td width="150">&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="150">Vorname</td>
<td>
<input name="txtFirstname" type="text" id="txtFirstname" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte gib deinen Vornamen ein." />
</td>
<td width="250">
</td>
</tr>

<tr>
<td width="150">Nachname</td>
<td>
<input name="txtLastname" type="text" id="txtLastname" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte gib deinen Nachnamen ein." />
</td>
<td width="250">
</td>
</tr>

<tr>
<td width="150">Stra&szlig;e Nummer</td>
<td>
<input name="txtStreet" type="text" id="txtStreet" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte gib deine Straße und Hausnummer,<br />und ggf. Adresszusätze ein." />
</td>
<td width="250">
</td>
</tr>
<tr>
<td width="150">PLZ</td>
<td colspan="2">
<input name="txtzip" type="text" id="txtzip" size="9" maxlength="9" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte gib die Postleitzahl zu deinem Ort ein." />
</td>
</tr>
<tr>
<td width="150">Wohnort</td>
<td colspan="2">
<input name="txtcity" type="text" id="txtcity" value="" required="true" dojoType="dijit.form.ValidationTextBox" promptMessage="Bitte gib deinen Wohnort ein." />
</td>
</tr>

<tr>
<td width="150">Land</td>
<td>




<select name="txtCountry" style="width:212px;overflow:hidden;font-size:12px">
<?php
//echo 'Your country name is '. $ip2c->get_country_name() . '<br>';
//echo 'Your country code is ' . $ip2c->get_country_code();
	foreach($countries as $country_code=>$country_name) {
		$selected="";
		if($ip2c->get_country_code()==$country_code)
			$selected=" selected=\"selected\"";
		echo "<option value=\"".$country_code."\"".$selected.">".htmlspecialchars($country_name)."</option>";


	}
?>
</select>
</td>
<td width="250">
</td>
</tr>

<tr>
<td width="150">&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>

<tr>
<td width="150">eMail-Adresse</td>
<td>
<input name="txtMail" type="text" id="txtMail" value="" required="true" dojoType="dijit.form.ValidationTextBox" regExpGen="dojox.validate.regexp.emailAddress" trim="true" 
promptMessage="Bitte gib deine eMail-Adresse ein." 
invalidMessage="Ungültige eMail-Adresse." maxlength="35" />
</td>
<td width="250">
</td>
</tr>

<tr>
<td width="150">eMail-Adresse wiederholen</td>
<td>
<input name="txtMail" type="text" id="txtMail2" value="" required="true" dojoType="dijit.form.ValidationTextBox" regExpGen="dojox.validate.regexp.emailAddress" trim="true" 
promptMessage="Bitte wiederhole deine eMail-Adresse aus Sicherheitsgründen." 
invalidMessage="Ungültige eMail-Adresse." maxlength="35" />
</td>
<td width="250">
</td>
</tr>


<tr>
<td width="150">&nbsp;</td>
<td colspan="2">

 <button dojoType="dijit.form.Button" type="submit" name="btnLogin"
            value="Submit" onClick="return validateLogin();">
                Registrierung abschließen
            </button>


</td>
</tr>




</table>
<input name="txtRegister" type="hidden" id="txtRegister">
</div>







	</td>
	<td valign="top">

		<img src="img/ci/livread9b_small.gif" border="0" />



	</td>
</tr>
</table>



<?php

$helpEbookReaderIntegrated="";
$helpEbookReaderIntegrated.="<strong>Bitte fülle alle Felder aus</strong><p>Nach erfolgreicher Registrierung bekommst Du per eMail einen Bestätigungslink zugesendet. Nach dem Du mit diesem Link Deine Angaben bestätigt hast, kannst Du selbst eBooks hochladen, verwaltem und lesen und Livread in vollem Umfang nutzen.</p>";
$helpEbookReaderIntegrated.="";

?>


<script type="text/javascript">
var tp;
parent.dojo.addOnLoad(function() {
	parent.document.getElementById("paneLeftInfoPane").innerHTML="";
	tp = new parent.dijit.TitlePane({
	    title: "Hilfe zur Registrierung",
	    content: "<div id='MyLeftPaneInfoReader'></div>"
	});
	parent.document.getElementById("paneLeftInfoPane").appendChild(tp.domNode);
});

	parent.document.getElementById("MyLeftPaneInfoReader").innerHTML="<?php echo $helpEbookReaderIntegrated;?>";

</script>

