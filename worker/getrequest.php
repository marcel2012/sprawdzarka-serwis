<?php
	require_once "../api/main.php";
	$sql=mysqli_query($mysqli,"SELECT *,(SELECT tester FROM zadanie WHERE id=request.zadanie) as tester FROM request WHERE status=0 ORDER BY ID ASC");
	if(!sql)
		die('-1');
	if($row=mysqli_fetch_assoc($sql))
		die($row["id"]." ".$row["zadanie"]." ".$row["tester"]);
	else
		die('-1');
?>