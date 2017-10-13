<?php
    require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
	$sql=mysqli_query($mysqli,"DELETE FROM groups WHERE id=".intval($_GET["id"]));
	if(!$sql)
		die('{"query":0,"error":-1}');
	else
		die('{"query":1}');
?>
