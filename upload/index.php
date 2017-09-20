<?php
	require_once "../api/main.php";
	session_id($_POST["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
	$sql=mysqli_query($mysqli,"INSERT INTO request SET user=".$_SESSION["id"].",
		status=0,
		zadanie=".intval($_POST["zadanie"]).",
		wynik=0,
		info='',
		info2='',
		info3=''");
	if(!$sql)
		die('{"query":0,"error":-1}');
	$id=mysqli_insert_id($mysqli);
	$target_file = "../files/" .$id.".cpp";
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    die('{"query":0,"error":2}');
	}
	if ($_FILES["file"]["size"] > 5000000) {
	    echo "Sorry, your file is too large.";
	    die('{"query":0,"error":3}');
	}
	    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			if(!isset($_SESSION["admin"]))
				header("Location: /sprawdzarka/main/");
			else
	    		header("Location: /sprawdzarka/admin/main/");
	   	 	die('{"query":1}');
	    } else {
	   	 die('{"query":0,"error":4}');
	    }
?>