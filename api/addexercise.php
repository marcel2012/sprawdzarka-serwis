<?php
    require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
	$sql=mysqli_query($mysqli,"INSERT INTO zadanie SET tests='".mysqli_real_escape_string($mysqli,$_GET["tests"])."',maxtime=".intval($_GET["maxtime"]).", outputtest='".mysqli_real_escape_string($mysqli,$_GET["output"])."',inputtest='".mysqli_real_escape_string($mysqli,$_GET["input"])."',output='".mysqli_real_escape_string($mysqli,$_GET["wyjscie"])."',input='".mysqli_real_escape_string($mysqli,$_GET["wejscie"])."', description='".mysqli_real_escape_string($mysqli,$_GET["opis"])."', name='".mysqli_real_escape_string($mysqli,$_GET["nazwa"])."'");
	if(!$sql)
		die('{"query":0,"error":-1}');
	else
		die('{"query":1}');
?>
