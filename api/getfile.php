<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    if(!isset($_SESSION["admin"]))
        die('{"query":0,"error":1}');
    $list=glob("../files/data-".intval($_GET["id"])."-*.in");
    echo '{"query":1,"file":'.escape(file_get_contents("../files/".$_GET["name"])).'}';
?>
