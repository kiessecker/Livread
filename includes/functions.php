<?php

require_once('includes/eBookLib/ebookRead.php');
require_once('includes/eBookLib/ebookData.php');


## Statistic Inquiry ########################################################################################
function livreadStats($mode="Regular Request") {
	$sql="INSERT INTO stats (
			stats_date, 
			stats_username,
			stats_browser,
			stats_ip,
			stats_scriptname,
			stats_mode) 
		VALUES ('".date("Y/m/d H:i")."',
			'".addslashes($_SESSION["username"])."',
			'".addslashes($_SERVER["HTTP_USER_AGENT"])."',
			'".addslashes($_SERVER["REMOTE_ADDR"])."',
			'".addslashes($_SERVER["PHP_SELF"])."',
			'".addslashes($mode)."'
		)";
	mysql_query($sql);

}


## Synchronisation Function Requested by livreadSynchronize() only!! ########################################
function livreadSynchronizeRecursing($dir){
	global $dirs;
	global $fullpaths;

	if(substr($dir,-1) !== '/') { $dir .= '/'; }
	if($handle = opendir($dir)) {
		while (false!==($file=readdir($handle))) {
			if(filetype($dir.$file) === 'file' && $file != "." && $file != "..") {
				if(eregi("\.txt$",$file)) {
					$tmp=explode("/",$dir);
					$fullpath=trim($dir.$file);
					$fullpaths[]=$fullpath;
					$author=trim($tmp[3]);
					$title=$tmp[4];
					if(isset($tmp[5])) $title.=" - ".$tmp[5];
					if(isset($tmp[6])) $title.=" - ".$tmp[6];
					if(isset($tmp[7])) $title.=" - ".$tmp[7];
					if(isset($tmp[8])) $title.=" - ".$tmp[8];
					if(isset($tmp[9])) $title.=" - ".$tmp[9];
					$title=trim(ereg_replace("\- *","",$title));
					// wenn schon vorhanden:
					// checken nach Dateigroesse
					// wenn nicht identisch 
					$current_filesize=filesize($fullpath);

					// wenn noch keins mit dem Pfad ist:

					$sql="SELECT book_id, book_filesize FROM books WHERE book_path='".addslashes($fullpath)."'";
					$result=mysql_query($sql);

					if(mysql_num_rows($result)==0) {
						$content=file($fullpath);
						$content=implode(" ",$content);

						$sql="INSERT INTO books (book_title, book_author, 
									 book_dateadded, book_path, original_content, book_filesize) 
							VALUES ('".addslashes($title)."',
								'".addslashes($author)."',
								'".date("Y-m-d")."',
								'".addslashes($fullpath)."',
								'".addslashes($content)."',
".$current_filesize.")";
						$result=mysql_query($sql);
					} else {
						// check filesize, if differs
						// update content and remove from 
						// bookmarks and contents
						$current_sql_result=mysql_fetch_assoc($result);
						$result_sql_filesize=$current_sql_result["book_filesize"];
						$result_sql_bookid=$current_sql_result["book_id"];
						if($result_sql_filesize!=$current_filesize) {
							echo "Updating: ".$fullpath."<br />";

							$content=file($fullpath);
							$content=implode(" ",$content);

							$sql="UPDATE books SET original_content='".addslashes($content)."', book_filesize=".$current_filesize." WHERE book_id=".$result_sql_bookid;
							$result=mysql_query($sql);

							$sql="DELETE FROM bookmarks WHERE book_id=".$result_sql_bookid;
							$result=mysql_query($sql);


							$sql="DELETE FROM currposition WHERE book_id=".$result_sql_bookid." AND username='".addslashes($_SESSION["username"])."'";

$result=mysql_query($sql);




							$sql="DELETE FROM contents WHERE book_id=".$result_sql_bookid;
							$result=mysql_query($sql);
						}
					}
					// fullpath in array und am Schluß säubern!
				}
			}


 			if (filetype($dir.$file) === 'dir' && $file != "." && $file != "..") {
				clearstatcache();
				$dirs .= $file . "\n";
				livreadSynchronizeRecursing($dir . $file);
			}
		}
		closedir($handle);
	}
	return $dirs;
}


## Synchronisation Function #############################################################################
function livreadSynchronize() {
	global $fullpaths;
	livreadSynchronizeRecursing("./repository/".$_SESSION["username"]);

	// alle fullpath werte aus datenbank und wenn einer im fullpaths-array nicht existiert, dann aus der datenbank löschen
	// durch alle fullpaths skippen
	$sql="SELECT book_id, book_path FROM books WHERE book_path LIKE '%repository/".$_SESSION["username"]."/%' ";
	$result=mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) { 
		$current_fullpath=$row["book_path"];
		if(!in_array($current_fullpath,$fullpaths)) {
			// säubern: entferne alle Bücher aus der Datenbank, die im lokalen Filesystem nicht mehr vorhanden sind!
			$sql="DELETE FROM books WHERE book_id=".$row["book_id"];
			$result2=mysql_query($sql);

			$sql="DELETE FROM contents WHERE book_id=".$row["book_id"];
			$result2=mysql_query($sql);

			$sql="DELETE FROM bookmarks WHERE book_id=".$row["book_id"];
			$result2=mysql_query($sql);


		}
	}
}




## Convert any uploaded/existing ebook to any format using ebook-convert natively from calibre #############
function livreadEbookConvert2Any($inputFile,$file_ext,$targetFormat=".txt") {
	# We cread random id
	$uuid="convert".rand(100000000,900000000);
	# We copy source file to tmp dir
	copy($inputFile,"/tmp/".$uuid.$file_ext);

	# We create a script file, that will convert to ePub
/*
	$fh=fopen("/tmp/ebook-convert","w+");
	fwrite($fh,"#!/bin/bash");
	fwrite($fh,"\necho \"".KIESSECKER_PASS."\" | sudo -S -u kiessecker env WINEPREFIX=\"/home/kiessecker/.wine-calibre\" xvfb-run -a wine /home/kiessecker/.wine-calibre/drive_c/Programme/Calibre2/ebook-convert.exe ".escapeshellarg("/tmp/".$uuid.$file_ext)." ".escapeshellarg("/tmp/".$uuid.".txt")." ");
	fclose($fh);
	exec("chmod 777 /tmp/ebook-convert");
	sleep(5);
*/
	$returnvar=exec("\necho \"".KIESSECKER_PASS."\" | sudo -S -u kiessecker env WINEPREFIX=\"/home/kiessecker/.wine-calibre\" xvfb-run -a wine /home/kiessecker/.wine-calibre/drive_c/Programme/Calibre2/ebook-convert.exe ".escapeshellarg("/tmp/".$uuid.$file_ext)." ".escapeshellarg("/tmp/".$uuid.$targetFormat)." ");
	copy("/tmp/".$uuid.$targetFormat,eregi_replace($file_ext."$",$targetFormat,$inputFile));
	
	// noch beide Dateien löschen

	return $returnvar;
}

## Remove the unzipped ebook
function livreadBookRemoveFiles($target) {
	if(!ereg("^".str_replace("/","\/",EBOOKHTML_BASE_DIR),realpath($target)))
		die("Error \#13018913"); // target value must bei something like ./ebookHTML/[0-9]+/ (with final slash
	// delete if already exists
	exec("rm -rf ".$target);
}


## Unzip the epub file of the user to the target recursely; for having media contents available #############
function livreadBookUnzip($file,$target, $isFromCrossMode=false) {
//	echo $file;
//	echo $target;
	if(!ereg("^".str_replace("/","\/",EBOOKHTML_BASE_DIR),realpath($target)))
		die("Error \#13018913"); // target value must bei sth like ./ebookHTML/[0-9]+/ (with final slash
	// start unzipping

	if($isFromCrossMode==false)
		$zip=zip_open(realpath(".")."/".$file);
	else
		$zip=zip_open($file);



	if(!$zip) { return("Unable to proccess file '{$file}'"); }
	$e='';

	while($zip_entry=zip_read($zip)) {
		$zdir=dirname(zip_entry_name($zip_entry));
		$zname=zip_entry_name($zip_entry);

		if(!zip_entry_open($zip,$zip_entry,"r")) {
			$e.="Unable to proccess file '{$zname}'";
			continue;
		}
	
		if(!is_dir($target.$zdir)) {
			livreadBookUnzipHelperRecurseMkdir($target.$zdir,0777);
		}
		#print "{$zdir} | {$zname} \n";

		$zip_fs=zip_entry_filesize($zip_entry);
		if(empty($zip_fs)) continue;

		$zz=zip_entry_read($zip_entry,$zip_fs);

		if(eregi("php$",$zname) || 
		   eregi("php3$",$zname) ||
		   eregi("php4$",$zname) ||
		   eregi("php5$",$zname) ||
		   eregi("cgi$",$zname) ||
		   eregi("asp$",$zname) ||
		   eregi("perl$",$zname) ||
		   eregi("pl$",$zname) ||
		   eregi("sht$",$zname) ||
		   eregi("shtm$",$zname) ||
		   eregi("shtml$",$zname)) 
			die ("You tried to upload an ebook containing at least one script file! 
				This is a security concern! Therefore your action had canceled. 
				Please modify your epub book not to contain server scripting files!");

		$z=fopen($target.$zname,"w");
		fwrite($z,$zz);
		fclose($z);
		zip_entry_close($zip_entry);

	}
    zip_close($zip);

    return($e);
}



## Helper for Unzip function above #######################################################################
function livreadBookUnzipHelperRecurseMkdir($pn,$mode=null) {
	if(is_dir($pn) || empty($pn)) 
		return true;
	$pn=str_replace(array('/', ''),DIRECTORY_SEPARATOR,$pn);

	if(is_file($pn)) {
		trigger_error('livreadBookUnzipHelperRecurseMkdir() File exists', E_USER_WARNING);
		return false;
	}
	$next_pathname=substr($pn,0,strrpos($pn,DIRECTORY_SEPARATOR));
	if(livreadBookUnzipHelperRecurseMkdir($next_pathname,$mode)) {
		if(!file_exists($pn)) {
			return @mkdir($pn,$mode);
		} 
	}
	return false;
}


## Check if user posesses this book ####################################################################
function livreadDoesUserOwnBook($book_id) {
	# Does the user own the book?
	$sql="SELECT book_id FROM books WHERE book_id=".(int)$book_id." AND book_path LIKE './repository/".$_SESSION["username"]."/%' LIMIT 0,1";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)<1) 
		return false;
	else
		return true;
}



## Walk through the entire manifest (after having the epub unzipped) and modify the paths to fit with subfolder structure
function livreadBookAdaptURLs($manifest,$replaceURLPrefix,$toc) {
	// do this only ONCE(!!)
	if(file_exists($replaceURLPrefix."URLSPARSED")) {
		echo "sss";
		return;
	}

	$replaceInDocuments=array();
	$document_hrefs=array();
	$replaceURLs=array();
	$toc_link_array=array();
//	print_r($manifest);
	foreach($toc as $value) {
		$toc_link_array[]=$value->fileName;
	}
	$toc_link_array=array_reverse($toc_link_array);


	foreach($manifest as $value) {
		if(eregi("xml",$value->type) || eregi("htm",$value->type)) {
			$replaceInDocuments[]=$value->href;
			$document_hrefs[]=$value->href;
		}
		if(eregi("^image\/",$value->type)) {
			$replaceURLs[]=$value->href;
		}
	}


	foreach($replaceInDocuments as $docPath) {
		$docPath=$replaceURLPrefix.$docPath;
		$file=file($docPath);
		$file=implode("",$file);

		// images
		foreach($replaceURLs as $replaceString) {
//			echo "<br>".$replaceString."=".$replaceURLPrefix.$replaceString;
			$file=str_replace($replaceString,$replaceURLPrefix.$replaceString,$file);
		}

/*
		// links from toc
		foreach($toc_link_array as $replaceString) {
			$file=str_replace("\"".$replaceString."\"","\"#\" onClick=\"alert('".$replaceURLPrefix.$replaceString."')\"",$file);
			$file=str_replace("'".$replaceString."'","'#' onClick='alert(\"".$replaceURLPrefix.$replaceString."\")'",$file);
		}
*/


/*
		// links of documents
		foreach($document_hrefs as $replaceString) {
			while(eregi("\"".$replaceString."(#([A-Za-z0-9]|\_|\-)+)?\"",$file,$match)) {
				$file=str_replace($match[0],"\"#\" onclick=\"livreadLink('".ereg_replace("\"$","",$replaceURLPrefix.ereg_replace("^\"","",$match[0]))."')\"",$file);
			} 

			while(eregi("'".$replaceString."(#([A-Za-z0-9]|\_|\-)+)?'",$file,$match)) {
				$file=str_replace($match[0],"'#' onclick='livreadLink(\"".ereg_replace("'$","",$replaceURLPrefix.ereg_replace("^'","",$match[0]))."\")'",$file);
			} 
		}
		$file=eregi_replace("href( |\n|\t|\r)*=( |\n|\t|\r)*\"#\"","",$file);
		$file=eregi_replace("href( |\n|\t|\r)*=( |\n|\t|\r)*'#'","",$file);

*/
		// we disable links at all for the moment
		$file=eregi_replace("href( |\n|\t|\r)*=( |\n|\t|\r)*'","title='",$file);
		$file=eregi_replace("href( |\n|\t|\r)*=( |\n|\t|\r)*\"","title=\"",$file);



		if(!ereg("^".str_replace("/","\/",EBOOKHTML_BASE_DIR),realpath($docPath)))
			die("Error \#13018913"); // target value must bei something like ./ebookHTML/[0-9]+/ 


		$fh=fopen($docPath,"w+");
		fwrite($fh,$file);
		fclose($fh);
	}

//	exit;


	$fh=fopen($replaceURLPrefix."URLSPARSED","w+");
	fwrite($fh,"true");
	fclose($fh);

}






## Send a complex array object with all neccessary epub-Data for reader #####################################
function livreadCreateEpubContentForReader($book_id,$createEvenIfDataExists=0, $isFromCrossMode=false,$book_path=null) {
	// we check, if we already have the data
	if(file_exists("./ebookHTML/".$book_id."/LIVREAD-MANIFEST") && $createEvenIfDataExists!=1) {
		$file=file("./ebookHTML/".$book_id."/LIVREAD-MANIFEST");
		$file=implode("",$file);
		$JSON=json_decode($file,true);
		return $JSON;
		exit;
	}





	if($isFromCrossMode==false) {

		// if $createEvenIfDataExists==1 it will create the entire things

		/* Existiert epub-Version des Buches? Wenn nicht wird sie erstellt */
		$sql="SELECT book_epubcontent, book_author, book_title, book_path FROM books WHERE book_id=".(int)$book_id." LIMIT 0,1";
		$result=mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$target_path = "./repository/".$_SESSION["username"]."/".$row["book_author"]."/".$row["book_title"]."/".$row["book_title"]." - ".$row["book_author"].".txt";
		$epub_path=$row["book_path"];
		$epub_path=ereg_replace("^\./","",$epub_path);
		$epub_path=eregi_replace(".txt$",".epub",$epub_path);

		$book_path=$epub_path;



		if(!is_file($book_path)) { 
			livreadEbookConvert2Any($target_path,".txt",".epub");
		} 
	}

	/* Retrieve the book data and contents */
	$ebook = new ebookRead($book_path); // full path to epub file inside repository
	$currentBook_title=$ebook->getDcTitle();
	$currentBook_creator=$ebook->getDcCreator();
	$currentBook_description=$ebook->getDcDescription();
	$currentBook_isbn=$ebook->getDcIdentifier();
	$currentBook_contributor=$ebook->getDcContributor();
	$currentBook_contributorRole=$ebook->getDcContributor("Role");
	$currentBook_language=$ebook->getDcLanguage();
	$currentBook_rights=$ebook->getDcRights();
	$currentBook_publisher=$ebook->getDcPublisher();
	$currentBook_subject=$ebook->getDcSubject();
	$currentBook_date=$ebook->getDcDate();
	$currentBook_type=$ebook->getDcType();
	$currentBook_format=$ebook->getDcFormat();
	$currentBook_source=$ebook->getDcSource();
	$currentBook_relation=$ebook->getDcRelation();
	$currentBook_coverage=$ebook->getDcCoverage();
	$currentBook_toc=$ebook->getTOC();

//	print_r($currentBook_toc); exit;


	$ebookData = $ebook->getEBookDataObject();
	$currentBook_manifest=$ebookData->manifestData;
	$currentBook_spineInfo = $ebook->getSpine();
	$currentBook_contentFolder=$ebookData->contentFolder;
	// echo "Debug:<br />";
	// echo "manifest_Data<br/>:";
	// print_r($currentBook_manifest);
	// das hat alle Links und seiten drin
	// echo "TOC-DATA\n";
	// print_r($currentBook_toc);
	// echo "\n\nSPINE-DATA\n";
	// das hat jeweils den ersten Link zu einem jeden eigenen xhtml-Dokument
	// print_r($currentBook_spineInfo);


	/* Output the ebook */
	$output="";
	$READER_FILES=array();
	$currentBook_contentFiles=array();
	//print_r($currentBook_spineInfo);
	for($x = 0;$x < count($currentBook_spineInfo);$x+=1){		
		$manItem = $ebook->getManifestById($currentBook_spineInfo[$x]);
		//echo $manItem->id; // id des dokuments
		$currentBook_contentFiles[]="ebookHTML/".$book_id."/".$currentBook_contentFolder.$manItem->href; // dateinamen; vielleicht dies als div id
		$content = $ebook->getContentById($manItem->id);
		//echo $content;

		if(preg_match("/<body[^>]*>.*<\/body>/si", $content, $matches))
			$content=$matches[0];
		$content=preg_replace("/<body[^>]*>/si", "",$content);
		$content=preg_replace("/<\/body>/si", "",$content);
	//	$content=strip_tags($content,"<p><a><img><h1><h2><h3><li><ul><ol><blockquote><a><br><br /><table><tr><td>");
		$output.="\n\n<a id=\"livRead".$manItem->href."\"><!-- livReadAnchor -->\n".$content;
		$curr_file="ebookHTML/".$book_id."/".$manItem->href;
		$READER_FILES[]=$curr_file;
	}


	/* hier noch, wenn keine TOC-Daten und mehr als eine manifest Datei (das aus der schleife oben beziehen,
	dann eigenes TOC machen aus livReadAnchor */



	/* TOC parsing, sodaß interne Links funktionieren */
	$toc_parsed=array();
	$count_toc_entries=0;
	foreach($currentBook_toc as $value) {
	//	echo $value->name.":";
		$href_orig=$value->fileName;
		$href=explode("#",$href_orig);
		if(count($href)==2) {
	//		echo "<br>".$href_orig."==>".$href[0];
			$output=str_replace($href_orig,$href[1],$output);
		} else {
			$href[1]=$href_orig;	
			//die("error #12101");
		}
		$toc_parsed[$count_toc_entries]["title"]=$value->name;
		$toc_parsed[$count_toc_entries]["ref"]=$href[1];
		$count_toc_entries++;
	}

	/* Parsing of filenames inside of the document content, e.g. inherent links 
	 replace all href-filenames, e.g. links, that are inside of the document itself */
	foreach($currentBook_contentFiles as $value) {
		$output=str_replace($value,"",$output);
	}


	//print_r($toc_parsed);



	/* Check if epub-file is already available within ./ebookHTML/id/? Otherwise unzip it there to */
	if($createEvenIfDataExists==1 || !is_dir("./ebookHTML/".$book_id)) {
		livreadBookRemoveFiles("./ebookHTML/".$book_id);
		livreadBookUnzip($book_path,"./ebookHTML/".$book_id."/",$isFromCrossMode);
		livreadBookAdaptURLs($currentBook_manifest,"ebookHTML/".$book_id."/".$currentBook_contentFolder,$currentBook_toc);
	}


	$bookData=array("BOOKINFO"=>array("title"=>$currentBook_title,"creator"=>$currentBook_creator,"urlprefix"=>"ebookHTML/".$book_id."/".$currentBook_contentFolder),
			   "TOCParsed"=>$toc_parsed,
			   "TOC"=>$currentBook_toc,
			   "MANIFEST_DATA"=>$currentBook_manifest,
			   "SPINEINFO"=>$currentBook_spineInfo,
			   "FILES_OF_BOOK"=>$currentBook_contentFiles,
			   "CONTENT"=>$output);



	$JSON=json_encode($bookData);
	$fh=fopen("./ebookHTML/".$book_id."/LIVREAD-MANIFEST","w+");
	fwrite($fh,$JSON);
	fclose($fh);

	$file=file("./ebookHTML/".$book_id."/LIVREAD-MANIFEST");
	$file=implode("",$file);
	$JSON=json_decode($file,true);
	return $JSON;

}















# var_dump(get_defined_vars()); // dumps anything at all
livreadStats();


?>
