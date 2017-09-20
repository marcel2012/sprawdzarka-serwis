<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sq=mysqli_query($mysqli,"SELECT *,(SELECT maxtime FROM zadanie WHERE id=request.zadanie) as maxtime FROM request WHERE id=".intval($_GET["id"]).(!isset($_SESSION["admin"])?" AND user=".$_SESSION["id"]:""));
	$sql=mysqli_query($mysqli,"SELECT * FROM requestid WHERE request=".intval($_GET["id"]).(!isset($_SESSION["admin"])?" AND user=".$_SESSION["id"]:"")." ORDER BY test ASC");
	if(!sql)
		die('{"query":0,"error":-1}');
	$ro=mysqli_fetch_assoc($sq);
	echo '{"query":1,"maxtime":'.$ro["maxtime"].',"log":"'.base64_encode($ro["info"].$ro["info2"]).'","request":[';
	$f=false;
	while($row=mysqli_fetch_assoc($sql))
	{
		if($f)
			echo ",";
		else
			$f=true;
		echo '{"id":'.$row["id"].',"wynik":'.$row["wynik"].',"test":'.$row["test"].',"status":'.$row["status"].',"time":'.$row["time"].',"info":"'.$row["info"].'","info2":"'.$row["info2"].'","info3":"'.$row["info3"].'"}';
	}
	echo ']}';
?>
