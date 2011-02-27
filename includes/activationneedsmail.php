<?php


# -=-=-=- MIME BOUNDARY

$mime_boundary = "----www.livread.com----".md5(time());

# -=-=-=- MAIL HEADERS

$to = addslashes($regMail);
$subject = "Aktivierung notwendig - Livread Online eBook Lesesystem und Private Bibliothek";

$headers = "From: Livread.com <temp@livread.com>\n";
$headers .= "Reply-To: Livread.com <temp@livread.com>\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";

# -=-=-=- TEXT EMAIL PART

$message = "--$mime_boundary\n";
$message .= "Content-Type: text/plain; charset=UTF-8\n";
$message .= "Content-Transfer-Encoding: 8bit\n\n";

$message .= "Herzlich willkommen bei Livread.com, Deinem Online eBook Lesegerät und Privater Bibliothek.\n\n";
$message .= "Du hast Dich auf Livread.com registriert.\n\n";
$message .= "Damit Du diesen Dienst verwenden kannst, ist eine Aktivierung nötig.\n\n";
$message .= "Bitte verwende dazu den nachfolgenden Link:\n\n";
$message .= "http://www.livread.com/activate.php?activationId=".$user_uuid."&reg=true";
$message .= "\n\n";
$message .= "Deine Benutzerdaten im Überblick:\n\n";
$message .= "Benutzername: ".addslashes($regUsername)."\n";
$message .= "Passwort: ".addslashes($regPassword1)."\n";
$message .= "Dein Name: ".addslashes($regFirstname)." ".addslashes($regLastname)."\n";
$message .= "Strasse: ".addslashes($regStreet)."\n";
$message .= "PLZ, Stadt: ".addslashes($regZip)." ".addslashes($regCity)."\n";
$message .= "Deine eMail-Adresse:".addslashes($regMail)."\n\n";
$message .= "Sobald Du den Aktivierungslink geklickt hast,\n";
$message .= "kannst Du den Dienst verwenden.\n\n";
$message .= "Bei Fragen wende Dich bitte temp@livread.com\n\n";
$message .= "Viel Spaß beim Lesen und Verwalten wünscht Dir das Team von Livread!\n\n";

# -=-=-=- HTML EMAIL PART
 
$message .= "--$mime_boundary\n";
$message .= "Content-Type: text/html; charset=UTF-8\n";
$message .= "Content-Transfer-Encoding: 8bit\n\n";

$message .= "<html>\n";
$message .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:14px; color:#666666;\">\n";
$message .= "<p>Herzlich willkommen bei Livread.com, Deinem Online eBook Lesegerät und Privater Bibliothek.</p>";
$message .= "<p>Du hast Dich auf www.livread.com registriert.</p>";
$message .= "<p>Damit Du diesen Dienst verwenden kannst, ist eine Aktivierung nötig.</p>";
$message .= "<p>Bitte verwende Sie dazu den nachfolgenden Link:<br />";
$message .= "<a href=\"\">http://www.livread.com/activate.php?activationId=".$user_uuid."&reg=true</a></p>";
$message .= "<p>Benutzername: ".addslashes($regUsername)."<br />";
$message .= "Passwort: ".addslashes($regPassword1)."<br />";
$message .= "Ihr Name: ".addslashes($regFirstname)." ".addslashes($regLastname)."<br />";
$message .= "Strasse: ".addslashes($regStreet)."<br />";
$message .= "PLZ, Stadt: ".addslashes($regZip)." ".addslashes($regCity)."<br />";
$message .= "Deine eMail-Adresse:".addslashes($regMail)."<br /><br />";
$message .= "Sobald Du den Aktivierungslink geklickt hast, kannst Du den Dienst verwenden.<br /></p>";
$message .= "<p>Bei Fragen wende Dich an temp@livread.com<br /><br />";
$message .= "Viel Spaß beim Lesen und Verwalten wünscht Dir das Team von Livread!</p>";
$message .= "</body>\n";
$message .= "</html>\n";

# -=-=-=- FINAL BOUNDARY

$message .= "--$mime_boundary--\n\n";

# -=-=-=- SEND MAIL

$mail_sent = mail(addslashes($regMail), $subject, $message, $headers );

?>
