<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
	echo '{"query":1,"file":"Dostęp zabroniony"}';
	//blokada
	//echo '{"query":1,"file":'.escape(mb_convert_encoding(file_get_contents("../files/".$_GET["name"]), 'HTML-ENTITIES', "UTF-8")).'}';
?>
