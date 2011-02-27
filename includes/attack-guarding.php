<?php

if(isset($_GET["book_id"])) {
	$query="SELECT * FROM books WHERE book_id=".(int)$_GET["book_id"]." AND book_path LIKE '".addslashes("./repository/".$_SESSION["username"])."%' LIMIT 0,1";

	echo $query; exit;
	$result=mysql_query($query);
	if(mysql_num_rows($result)==0) {
		// requested book being not the owner

//		echo $_GET["book"];
		unset($_GET["book"]);
		
	}
}










?>
