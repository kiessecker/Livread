<?php
# invocation during session management

				mail("activator@livread.com","livread.com Approval", "
					Ein neuer Benutzer wurde angelegt: Benutzername: ".addslashes($regUsername).", Passwort: ".addslashes($regPassword1).", Name: ".addslashes($regFirstname)." ".addslashes($regLastname).", Strasse, PLZ, Stadt:".addslashes($regStreet)." ".addslashes($regZip)." ".addslashes($regCity).", Mail:".addslashes($regMail));



?>
