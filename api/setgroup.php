<?php
    require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    $sql=mysqli_query($mysqli,"UPDATE users SET groups=".intval($_GET["id"])." WHERE id=".$_SESSION["id"]);
    $_SESSION["groups"]=intval($_GET["id"]);
	if(!$sql)
		die('{"query":0,"error":-1}');
	else
		die('{"query":1}');
?>
