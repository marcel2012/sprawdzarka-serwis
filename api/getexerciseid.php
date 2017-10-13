<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sql=mysqli_query($mysqli,"SELECT * FROM zadanie WHERE id=".intval($_GET["id"]).(!isset($_SESSION["admin"])?" AND visible=1":""));
	if(!sql)
		die('{"query":0,"error":-1}');
	echo '{"query":1,"exercise":[';
	$f=false;
	while($row=mysqli_fetch_assoc($sql))
	{
		if($f)
			echo ",";
		else
			$f=true;
		echo '{"tester":'.$row["tester"].',"maxtime":'.$row["maxtime"].',"id":'.$row["id"].',"groups":'.$row["groups"].',"visible":'.$row["visible"].',"tests":'.escape($row["tests"],false).',"nazwa":'.escape($row["name"]).',"wejscie":'.escape($row["input"],false).',"wyjscie":'.escape($row["output"],false).',"input":'.escape($row["inputtest"],false).',"output":'.escape($row["outputtest"],false).',"opis":'.escape($row["description"],false).',"wynik":'.intval($row["wynik"],false).'}';
	}
	echo ']}';
?>
