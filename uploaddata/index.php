<?php
	require_once "../api/main.php";
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
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    die('{"query":0,"error":2}');
	}
	if ($_FILES["file1"]["size"] > 25000000) {//5MB
	    echo "Sorry, your file is too large.";
	    die('{"query":0,"error":3}');
	}
	    if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file."in") && move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file."out")) {
	    	header("Location: /sprawdzarka/admin/editdata/#".$_POST["zadanie"]);
	   	 	die('{"query":1}');
	    } else {
	   	 die('{"query":0,"error":4}');
	    }
?>