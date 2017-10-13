<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sql=mysqli_query($mysqli,"SELECT id,name,description FROM groups ORDER BY id ASC");
	if(!sql)
		die('{"query":0,"error":-1}');
	echo '{"query":1,"mygroup":'.$_SESSION["groups"].',"group":[';
	$f=false;
	while($row=mysqli_fetch_assoc($sql))
	{
		if($f)
			echo ",";
		else
			$f=true;
		echo '{"desc":'.escape($row["description"],false).',"name":'.escape($row["name"]).',"id":'.$row["id"].'}';
	}
	echo ']}';
?>
