<?php
function sorting($a, $b)
{
    return ($a>$b);
}
	function random($length = 30)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
    function escape($str,$b=true)
    {
		if($b)
			$str=htmlentities($str);
        return json_encode($str);
    }
	error_reporting(0);
	header('Content-type: application/json');
	header('access-control-allow-origin: *');
	require_once "mysql_password.php";
	$mysqli = mysqli_connect($sv, $u,$p,$db);
	if (!$mysqli)
		die('{"query":0,"error":-1}');
	mysqli_select_db($mysqli,$db);
	mysqli_set_charset($mysqli,"utf8");
	if(isset($_GET["sessid"]))
		if(strlen($_GET["sessid"])<20)
			$_GET["sessid"]=random();
?>