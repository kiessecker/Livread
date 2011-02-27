<?php






$successfull_registration=false;

if(isset($_POST["txtRegister"])) {
	$regUsername=trim($_POST["txtUsername"]);
	$regUsername=str_replace("'","",$regUsername);
	$regUsername=str_replace("\"","",$regUsername);
	$regUsername=eregi_replace("repository","",$regUsername);
	$regPassword1=trim($_POST["txtPassword1"]);
	$regPassword2=trim($_POST["txtPassword2"]);
	$regFirstname=trim($_POST["txtFirstname"]);
	$regLastname=trim($_POST["txtLastname"]);
	$regStreet=trim($_POST["txtStreet"]);
	$regZip=trim($_POST["txtzip"]);
	$regCity=trim($_POST["txtcity"]);
	$regCountry=trim($_POST["txtCountry"]);
	$regMail=trim($_POST["txtMail"]);
	if(
		strlen($regUsername)>4 &&
		strlen($regPassword1)>2 &&
		$regPassword1==$regPassword2
	) {
		// check, if user exists, if not -> ok
		$query="SELECT * FROM users WHERE users_uid='".addslashes($regUsername)."' LIMIT 0,1";
		$result=mysql_query($query);
		if (mysql_num_rows($result)>0) {
			// failed, Username already exists
			$errorMessage = "Benutzername bereits vergeben. <br />Registrierung gescheitert.";
			$_GET["register"]=true;
		} else {
			// ok anlegen
			$user_uuid=date("U").rand(100000000,900000000)."XAs".md5(date("U"));
			$query="INSERT INTO users (
			users_uid, users_pwd, users_firstname, users_lastname, 
			users_street, users_zip, users_city, users_country, users_registrationdate, users_mail,users_valid,users_speakingallowed,users_uuid,users_defaultreader)
			VALUES ('".addslashes($regUsername)."','".addslashes($regPassword1)."','".addslashes($regFirstname)."','".addslashes($regLastname)."',
			'".addslashes($regStreet)."','".addslashes($regZip)."','".addslashes($regCity)."',
			'".addslashes($regCountry)."','".date("Y-m-d")."','".addslashes($regMail)."',0,1,'".$user_uuid."',".APPLICATION_DEFAULT_READER.")";

			$result=mysql_query($query);
			if($result!=1) {
				echo "Ein Fehler ist aufgetreten im session-management";
				exit;
			} else {

				require("includes/mailme.php");
				require("includes/activationneedsmail.php");



				$_POST["txtUserId"]=$regUsername;
				$_POST["txtPassword"]=$regPassword1;
				$_GET["tutorial"]="true";
				$successfull_registration=true;
			}

		}
	} else {
		// Bitte prüfen Benutzername > 4 Zeichen; Password und Wiederholung
		$errorMessage = "Bitte pr&uuml;fen Sie, die L&auml;nge von Benutzernamen, Passwort und die &Uuml;bereinstimmung der Passw&ouml;rter. <br />Registrierung gescheitert.";
		$_GET["register"]=true;
	}
}




if(isset($_GET["register"]) && $successfull_registration==false) {
	$_GET["applicationAction"]="register";
	$_GET["updateApplicationMenu"]=true;
//	require_once("includes/register.php");
//	exit;
}


# At first we start session
session_start();


# Direct Login of ebook.php via url
if($_SERVER["SCRIPT_NAME"]=="/ebook.php") {
	if(isset($_GET["livreaduriparameterebook1"]) && isset($_GET["livreaduriparameterebook2"])) {
		$_POST["txtUserId"]=$_GET["livreaduriparameterebook1"];
		$_POST["txtPassword"]=$_GET["livreaduriparameterebook2"];

	} else {
		// we do nothing
	} 
}


if(!isset($_SESSION["username"]))
	$_SESSION["username"]="anonymous";


# Autologin from Cookie
# Also wenn Session aktiviert und anonymous und keine Postvars des Login Feldes
if($_SESSION["username"]=="anonymous" && isset($_COOKIE["livreadUsername"]) && isset($_COOKIE["livreadPassword"])) {
	if(!isset($_POST["txtUserId"]) && !isset($_POST["txtPassword"])) {
		$_POST["txtUserId"]=$_COOKIE["livreadUsername"];
		$_POST["txtPassword"]=$_COOKIE["livreadPassword"];
	}
}

if(isset($_COOKIE["livreadActivated"])) {
	setcookie ("livreadActivated", "", time() - 3600);
	$livreadVarAccountActivated=true;
}






if(!isset($_SESSION["cssstyle"]))
	$_SESSION["cssstyle"]="brown"; // we have green and blue, too

$login_required=false;

if(isset($_GET["logout"])) {
	$_SESSION["username"]="anonymous";
	unset($_SESSION["may_read"]);
	unset($_SESSION["voice_active"]);

	setcookie ("livreadUsername", "", time() - 3600);
	setcookie ("livreadPassword", "", time() - 3600);
	setcookie ("livreadIsLogged", "false", time() + (3600)*24*365);


	header('Location: index.application.php?updateApplicationMenu=true&applicationAction=login');
	exit;
}




if (isset($_POST["txtUserId"]) && isset($_POST["txtPassword"])) {
	// check if the user id and password combination is correct
	$query="SELECT * FROM users WHERE users_uid='".addslashes($_POST["txtUserId"])."' AND users_pwd='".addslashes($_POST["txtPassword"])."' LIMIT 0,1";
	$result=mysql_query($query);

	if (mysql_num_rows($result)>0) {
		$row=mysql_fetch_assoc($result);
		$is_validated_user=$row["users_valid"];
		if($is_validated_user==1) {
			# Successfully log in
			$_SESSION["username"] = $_POST["txtUserId"];

			setcookie ("livreadUsername", $_SESSION["username"], time() + (3600)*24*365);
			setcookie ("livreadPassword", $_POST["txtPassword"], time() + (3600)*24*365);
			setcookie ("livreadIsLogged", "true", time() + (3600)*24*365);





			unset($_SESSION["may_read"]);
			unset($_SESSION["voice_active"]);
			unset($_SESSION["current_voice"]);
			unset($_SESSION["current_reader"]);

			// we do not welcomize if directly over ebook.php
			if($_SERVER["SCRIPT_NAME"]!="/ebook.php") {
				header('Location: index.application.php?updateApplicationMenu=true&applicationAction=welcome');
				exit;
			}

		} else {
			header('Location: index.application.php?updateApplicationMenu=true&applicationAction=login&approvalInfo=true&username='.urlencode($_POST["txtUserId"]));
			exit;
		}
	} else {
		$errorMessage = "Falsche Benutzer/Passwort-Kombination. <br />Anmeldung gescheitert.";
		$login_required=true;
	}
}



# Das ist so ok

if($_SESSION["username"]=="anonymous" || $login_required==true) {
	if( (count($_GET)==0 && count($_POST)==0))
		$_GET["applicationAction"]="login";


		if(isset($_POST["txtUserId"]) && isset($_POST["txtPassword"]) && $login_required==true)
		$_GET["applicationAction"]="login";


	$_GET["updateApplicationMenu"]=true;


}



if(!isset($_SESSION["voice_config_id"])) {
	$qryStr="SELECT * FROM users WHERE users_uid='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($qryStr);
	$users = mysql_fetch_assoc($result);
	if((int)$users["users_voice_config_id"]==0) {
		$_SESSION["voice_config_id"]=TTSDEFAULTVOICEID;
		$qryStr="UPDATE users SET users_voice_config_id=".$_SESSION["voice_config_id"]." WHERE users_uid='".addslashes($_SESSION["username"])."'";
		$result=mysql_query($qryStr);
	} else {
		$_SESSION["voice_config_id"]=$users["users_voice_config_id"];
	}
}



if(!isset($_SESSION["voice_paragraph"])) {
	$_SESSION["voice_paragraph"]="";
		$qryStr="UPDATE users SET users_curr_voice_reading_paragraph='' WHERE users_uid='".addslashes($_SESSION["username"])."'";
		$result=mysql_query($qryStr);
}

# We do not read the vars for anonymous, because anonymous only once is read
# during instantiation of session[voics_active] so any anonymous can have its own 
# preserved, but as regular user we read everytime probably we can dismiss this
# if we read this during setting of session_username. Because we have automatically
# anonymous and session is therefore already instantiated before really login in 
if(!isset($_SESSION["voice_active"])) {
	$qryStr="SELECT * FROM users WHERE users_uid='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($qryStr);
	$users = mysql_fetch_assoc($result);
	if((int)$users["users_voice_active"]==0) {
		$_SESSION["voice_active"]=0;
		$qryStr="UPDATE users SET users_voice_active=1 WHERE users_uid='".addslashes($_SESSION["username"])."'";
		$result=mysql_query($qryStr);
	} else {
		$_SESSION["voice_active"]=$users["users_voice_active"];
	}
}




if(!isset($_SESSION["current_voice"])) {
		$sql="SELECT users_voice_config_id FROM users WHERE users_uid='".addslashes($_SESSION["username"])."' LIMIT 0,1";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
	if((int)$row["users_voice_config_id"]>-1) {
		$_SESSION["current_voice"]=$row["users_voice_config_id"];
	} else {
		$_SESSION["current_voice"]=0;
	}
}


if(!isset($_SESSION["current_reader"])) {
		$sql="SELECT users_defaultreader FROM users WHERE users_uid='".addslashes($_SESSION["username"])."' LIMIT 0,1";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
	if((int)$row["users_defaultreader"]>=0) {
		$_SESSION["current_reader"]=$row["users_defaultreader"];
	} else {
		$_SESSION["current_reader"]=APPLICATION_DEFAULT_READER;
	}
}





if(!isset($_SESSION["may_read"])) {
	$qryStr="SELECT * FROM users WHERE users_uid='".addslashes($_SESSION["username"])."' LIMIT 0,1";
	$result=mysql_query($qryStr);
	if(mysql_num_rows($result)==0) {
		echo "Exit at position inc/sessmmgnt; tried to check if reading allowed, but user not found at all!";
		exit;
	}
	$users = mysql_fetch_assoc($result);
	$_SESSION["may_read"]=0;
	$_SESSION["may_read"]=(int)$users["users_speakingallowed"];
}






if(!is_dir("repository/".$_SESSION["username"])) {
	@mkdir("repository/".$_SESSION["username"]);
}


?>
