<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sql=mysqli_query($mysqli,"SELECT id,name FROM tester ORDER BY id ASC");
	if(!sql)
		die('{"query":0,"error":-1}');
	echo '{"query":1,"tester":[';
	$f=false;
	while($row=mysqli_fetch_assoc($sql))
	{
		if($f)
			echo ",";
		else
			$f=true;
		echo '{"name":'.escape($row["name"]).',"id":'.$row["id"].'}';
	}
	echo ']}';
?>
