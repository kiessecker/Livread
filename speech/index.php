<?php

header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("cache-control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");


#$_POST["voice"]="";
#$_POST["file"]="La le lu";


$uuid=date("U")."x".rand(0,100000000);



if(!isset($_POST["voice"]) && !isset($_POST["file"])) {
	echo "You aren't allowed to do this!";
	exit;
}


$voice=$_POST["voice"];
$file=$_POST["file"];

@system($voice);
system("echo \" \" | /home/kiessecker/bin/open-sapi/src/unstable/osapi-cli.tcl -a --purge --pipemode");
system("echo \"".$file."\" | /home/kiessecker/bin/open-sapi/src/unstable/osapi-cli.tcl --pfilename $uuid -a --purge --notxml --pipemode &");
sleep(3);
system("lame -V2 /tmp/speechdispatcher".$uuid.".wav /tmp/speechdispatcher".$uuid.".mp3");

?>
<iframe src="/stream.php?filename=<?php echo "speechdispatcher".$uuid.".mp3";?>"></iframe>


