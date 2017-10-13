<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sql=mysqli_query($mysqli,"SELECT *,a.id as rid,(SELECT name FROM zadanie WHERE id=a.zadanie) as zadanienazwa,(SELECT id FROM request WHERE (status=1 OR status=3) AND user=a.user AND zadanie=a.zadanie ORDER BY id DESC LIMIT 1) as id2 FROM request a INNER JOIN users b on b.id=a.user WHERE ".(!isset($_SESSION["admin"])?"a.user=".$_SESSION["id"]." AND ":"")." (SELECT groups FROM zadanie WHERE id=a.zadanie)=".$_SESSION["groups"]." ORDER BY a.id DESC");
	if(!sql)
		die('{"query":0,"error":-1}');
	echo '{"query":1,"request":[';
	$f=false;
	while($row=mysqli_fetch_assoc($sql))
	{
		if($f)
			echo ",";
		else
			$f=true;
		echo '{"class":'.$row["class"].',"date":'.escape($row["date"]).',"name":'.escape($row["name"]." ".$row["surname"]).',"id":'.$row["rid"].',"id2":'.intval($row["id2"]).',"zadanie":"'.$row["zadanienazwa"].'","zadanieid":'.$row["zadanie"].',"status":'.$row["status"].',"wynik":'.$row["wynik"].'}';
	}
	echo ']}';
?>
