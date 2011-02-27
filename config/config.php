<?php

$mysql_db="admin_livread_com";
$mysql_db_trans="admin_livread_com";
$mysql_user="livread_com";
$mysql_pass="sFDW3sd32";

define("SPEAK_TIME_ADVANTAGE_FOR_PROCESSING",3); 
// another seconds waiting for opensapi; 2 seconds was working fine for 1000-word-buffers
define("SPEAK_TIME_ADVANTAGE_FOR_PROCESSING_FIRST_WAIT",1); 


define("DEBUG_MODE",false); // sets ajax frame,... to view output
define("DEBUGFRAMEWIDTH",400);
define("DEBUGFRAMEHEIGHT",400);


define("TTSDEFAULTVOICEID",1);

$show_books_in_menu=false;
$dhtmlxdatagriddebugger=false;

$pagelenghwords=500;
$longpagelenghwords=500;
define("UNIQUEAPPNAME","Livread:com"); 
define("UNIQUEAPPNAME_IN_APPLICATION","Livread.com"); 


$db = mysql_connect("localhost",$mysql_user,$mysql_pass) or die("DB error");
mysql_select_db($mysql_db, $db);



$application_layout_screen["background_color"]="#FFEB9E";
define("SPEECHDISPATCHER","own"); // or "client"...
define("MYAPPADDRESS","http://www.livread.com/");
define("MENU_SHOW_NEWSPAPER_LINK",true);
define("ANONYMOUS_MAY_SYNCHRONIZE",false); // kurz auf true zu machen, um neue Bücher für anonymous einzulesen
define("LoquendoLicensed",false);

define("MAX_BOOKMARKS_IN_MENU",4);
define("REPOSITORY_BASE_DIR","/var/www/vhosts/livread.com/httpdocs/repository");
define("EBOOKHTML_BASE_DIR","/var/www/vhosts/livread.com/httpdocs/ebookHTML");
define("EBOOKSPEAKER_TXT_DIR","/var/www/vhosts/livread.com/httpdocs/tempReadAloud");

define("LOGFILE","/var/www/vhosts/livread.com/httpdocs/.log");
define("LOGGER_ACTIVE",true); // log any activity

define("KIESSECKER_PASS","PASS4LINUXUSER"); // password for the unix user (for calibre conversion as certain user)
define("DELAYSPEAK",0); // should we have a delay in finally outputting the read.php? This is how many seconds; Earlier I set this to 3, but it is probably not neccessary!


$APPLICATION_READERS=array(0=>"ebookextended",1=>"ebook",2=>"txt");
// This is an array of the readers; uses the field users.users_defaultreader
define("APPLICATION_DEFAULT_READER",0); // which should be the default reader for newly created accounts


function application_logger($message,$user) {
	if(LOGGER_ACTIVE==true) {
		$fh=fopen(LOGFILE,"a+");
		fwrite($fh,$user."::".$message."\n");
		fclose($fh);
	}
}





?>
