<?php
	require_once "main.php";
	if(!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL))
		die('{"query":0,"error":1}');
	if(strlen($_GET["email"])<3)
		die('{"query":0,"error":2}');
	if(strlen($_GET["email"])>50)
		die('{"query":0,"error":3}');
	if(strlen($_GET["pass"])<3)
		die('{"query":0,"error":4}');
	if(strlen($_GET["pass"])>50)
		die('{"query":0,"error":5}');
	$sql=mysqli_query($mysqli,"SELECT id,name,pass FROM users WHERE login='".mysqli_real_escape_string($mysqli,$_GET["email"])."'");
	if(!$sql)
		die('{"query":0,"error":-1}');
	if($row=mysqli_fetch_assoc($sql))
		if(password_verify($_GET["pass"],$row["pass"]))
		{
			session_start();
			$_SESSION["id"]=$row["id"];
			die('{"query":1,"name":"'.$row["name"].'","id":'.$row["id"].',"sessid":"'.session_id().'"}');
		}
	die('{"query":0,"error":6}');
?>
