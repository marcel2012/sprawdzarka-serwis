<?php
	require_once "../api/main.php";
	$sql=mysqli_query($mysqli,"SELECT * FROM request WHERE id=".intval($_GET["id"]));
	if(!$sql)
		die('-1');
	if($row=mysqli_fetch_assoc($sql))
	{
		$sql=mysqli_query($mysqli,"SELECT maxtime FROM zadanie WHERE id=".intval($_GET["zadanie"]));
		if(!$ro=mysqli_fetch_assoc($sql))
			die("-1");
		$sql=mysqli_query($mysqli,"SELECT * FROM request WHERE status=0 ORDER BY ID ASC");
		if(!sql)
			die('-1');
		if($tmp=mysqli_fetch_assoc($sql))
			if(intval($tmp["id"])<intval($_GET["id"]))
				die("-1");
		if(intval($_GET["time"])>$ro["maxtime"])
			$_GET["status"]=2;
		if($_GET["status"]==0)
			$status=2;
		if($_GET["status"]==1)
			$status=3;
		if($_GET["status"]==2)
			$status=3;
		if($_GET["status"]==3)
			$status=1;
		if($_GET["status"]==4)
			$status=3;
		if($_GET["status"]==5)
			$status=4;
		$punkt=100/sizeof(glob("../files/data-".$_GET["zadanie"]."-*.in"));
		$wynik=($_GET["status"]!=3?0:(intval($_GET["time"])<$ro["maxtime"]/2?$punkt:intval($punkt*2*($ro["maxtime"]-intval($_GET["time"]))/$ro["maxtime"])));
		$sql=mysqli_query($mysqli,"UPDATE request SET info='".mysqli_real_escape_string($mysqli,base64_decode($_GET["info"]))."', info2='".mysqli_real_escape_string($mysqli,base64_decode($_GET["info2"]))."', ".(isset($_GET["info3"])?"info3='".mysqli_real_escape_string($mysqli,base64_decode($_GET["info3"]))."',":"")." status=".intval($status)." WHERE id=".$row["id"]);
		if($_GET["status"]!=0 && $_GET["status"]!=5)
		{
			$sql=mysqli_query($mysqli,"INSERT INTO requestid SET 
				`user`=".intval($row["user"]).",
				`status`=".intval($_GET["status"]).",
				`zadanie`='".$_GET["zadanie"]."',
				`time`=".intval($_GET["time"]).",
				`request`=".intval($_GET["id"]).",
				`test`=".intval($_GET["test"]).",
				`wynik`=".$wynik."
				");
			$sql=mysqli_query($mysqli,"UPDATE request SET wynik=(SELECT SUM(wynik) FROM requestid WHERE `request`=".intval($_GET["id"]).") WHERE id=".$row["id"]);
		}
		die($row["id"]);
	}
	else
		die('-1');
?>
