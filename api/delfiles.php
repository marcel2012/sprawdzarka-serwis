<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
    unlink("../files/".$_GET["file1"]);
    unlink("../files/".$_GET["file2"]);
    echo '{"query":1}';
?>
