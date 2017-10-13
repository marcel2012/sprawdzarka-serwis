<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sql=mysqli_query($mysqli,"SELECT visible,id,name,(SELECT wynik FROM request WHERE `user`=".$_SESSION["id"]." AND zadanie=zadanie.id ORDER BY id DESC LIMIT 1) as wynik FROM zadanie WHERE ".(!isset($_SESSION["admin"])?"visible=1":"1")." AND groups=".$_SESSION["groups"]." ORDER BY id DESC");
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
		echo '{"id":'.$row["id"].',"visible":'.$row["visible"].',"nazwa":'.escape($row["name"].($row["visible"]==0?" (niewidoczne)":"")).',"wynik":'.(!is_null($row["wynik"])?$row["wynik"]:-1).'}';
	}
	echo ']}';
?>
