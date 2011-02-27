<?php

if(!eregi("MSIE (7|8)",$_SERVER["HTTP_USER_AGENT"])) {
	return true;
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Livread Ebook Reading</title>
	</head>
	<body>
		<h1>Ihr Browser wird wegen mangelhafter Acid3-Werte nicht unterst&uuml;tzt!</h1>
		<div>Unterst&uuml;tzte Browser:
			<ul>
				<li>Google Chrome &gt;=3.0</li>
				<li>Opera &gt;=10.0</li>
				<li>Safari &gt;=4.0</li>
				<li>Internet Explorer &gt;=9.0</li>
				<li>Mozilla Firefox Trunk Gecko &gt;=1.9.3</li>
				<li>Mozilla Firefox &gt;=3.6</li>
				<li>Konqueror &gt;=4.4</li>
			</ul>
		</div>
	</body>	

</html>

<?php exit; ?>
