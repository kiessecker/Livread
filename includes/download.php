<?php

$sql="SELECT book_id, original_content FROM books WHERE book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' AND book_id=".(int)$_GET["book"]." LIMIT 0,1";
	$result=mysql_query($sql);
	$does_book_exist=mysql_num_rows($result);
	if($does_book_exist>0) {
		$data=mysql_fetch_array($result);
		$original_content=$data["original_content"];
		$original_content=mb_convert_encoding($original_content,"UTF-8","Auto");

		$fh=fopen("./temp/download_as_file.".$_SESSION["username"].".txt","w+");
		fwrite($fh,$original_content);
		fclose($fh);
		?><a href="<?php
			echo "./temp/download_as_file.".$_SESSION["username"].".txt";


		?>">Download</a><?php

/*
	    header("Content-Description: File Transfer");
	    header("Content-Type: application/octet-stream");
	    header("Content-Disposition: attachment; filename=livread__book_".$_GET["book"].".txt");
	    header("Content-Transfer-Encoding: binary");
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Pragma: public");
//	    header('Content-Length: ' . filesize($file));
	    ob_clean();
	    flush();
	    readfile("./temp/download_as_file.".$_SESSION["username"]);
	    exit;
*/



	} else {
		echo "Buch existiert nicht!";
	}



