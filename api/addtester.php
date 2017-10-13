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
    $n=sizeof(glob("../tester/*.cpp"));
    $n+=1;
    $target_file = "../tester/".$n.".cpp";
    file_put_contents($target_file,$_POST["code"]);
	$sql=mysqli_query($mysqli,"INSERT INTO tester SET name='".mysqli_real_escape_string($mysqli,$_POST["name"])."'");
	header("Location: /sprawdzarka/admin/zadania/");
	die('{"query":1}');
?>