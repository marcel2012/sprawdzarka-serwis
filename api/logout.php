<?php
	require_once "main.php";
	session_start($_GET["sessid"]);
	session_destroy();
	die('{"query":1}');
?>
