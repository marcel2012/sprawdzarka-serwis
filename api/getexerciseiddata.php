<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
    $list=glob("../files/data-".intval($_GET["id"])."-*.in");
    usort($list, "sorting");
    echo '{"query":1,"file":[';
    for($i=0;$i<sizeof($list);$i++)
    {
		if($i)
            echo ",";
        echo '"'.str_replace(".in","",str_replace("../files/data-".intval($_GET["id"])."-","",$list[$i])).'"';
    }
	echo ']}';
?>
