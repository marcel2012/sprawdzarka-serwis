<?php
    require_once "../api/main.php";
    if(strlen($_POST["sessid"])<10)
        exit;
	session_id($_POST["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	if(!isset($_SESSION["admin"]))
		die('{"query":0,"error":1}');
	$sql=mysqli_query($mysqli,"SELECT lasttest FROM zadanie WHERE id=".intval($_POST["zadanie"]));
		if(!$sql)
			die('{"query":0,"error":-1}');
		if(!$row=mysqli_fetch_assoc($sql))
			die('{"query":0,"error":-1}');
			$sql=mysqli_query($mysqli,"UPDATE zadanie SET lasttest=lasttest+1 WHERE id=".intval($_POST["zadanie"]));
    $target_file = "../files/data-".intval($_POST["zadanie"])."-".($row["lasttest"]<10?"0":"").$row["lasttest"].".";
    file_put_contents($target_file."in",$_POST["in"]);
    file_put_contents($target_file."out",$_POST["out"]);
	header("Location: /sprawdzarka/admin/editdata/#".$_POST["zadanie"]);
	die('{"query":1}');
?>