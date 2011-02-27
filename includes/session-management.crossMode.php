<?php


if(isset($_GET["crossMode"]))  {
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);


	if(!isset($_GET["username"]))  {
		die("crossMode needs a valid username");
	} else {

		$_GET["username"] = base64_decode($_GET["username"]);
		$_GET["username"] = mcrypt_decrypt(MCRYPT_BLOWFISH, "kiDs256AFed412fSf", 
			$_GET["username"], MCRYPT_MODE_CBC,$iv);

		if(!$strpos=strpos($_GET["username"],"name:")) { die("ERROR: 2344202434. You did not provide existing username"); } 
		$_GET["username"]=substr($_GET["username"],$strpos+5,strlen($_GET["username"])-$strpos-5);


	}
}

$_GET["username"]=trim($_GET["username"]);


$query="SELECT * FROM users WHERE users_uid='".addslashes($_GET["username"])."' LIMIT 0,1";
$result=mysql_query($query);

$validUser=false;

if (mysql_num_rows($result)>0) {
	$row=mysql_fetch_assoc($result);
	$is_validated_user=$row["users_valid"];
	if($is_validated_user==1) {
		$validUser=true;
	}
}

if($validUser==false) {
	die("Error: 32423433. User: '".$_GET["username"]."' does not exist!");
}

$_SESSION["username"]=$_GET["username"];
$_SESSION["cssstyle"]="brown"; // we have green and blue, too
$_SESSION["voice_paragraph"]="";
$_SESSION["voice_active"]=0;
$_SESSION["current_voice"]=0;
$_SESSION["current_reader"]=1;
$_SESSION["may_read"]=0;




?>
