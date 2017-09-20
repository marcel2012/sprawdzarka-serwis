<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
	$sql=mysqli_query($mysqli,"DELETE FROM requestid WHERE zadanie=".$_GET["id"]);
	if(!sql)
		die('{"query":0,"error":-1}');
    $sql=mysqli_query($mysqli,"UPDATE request SET status=0, wynik=0,info='', info2='',info3='' WHERE zadanie=".$_GET["id"]);
    if(!sql)
            die('{"query":0,"error":-1}');
	echo '{"query":1}';
?>
