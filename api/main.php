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
	function http_post ($url, $data)
	{
		$data_url = http_build_query ($data);
		$data_len = strlen ($data_url);
	
		return array ('content'=>file_get_contents ($url, false, stream_context_create (array ('http'=>array ('method'=>'POST'
				, 'header'=>"Connection: close\r\nContent-Length: $data_len\r\n"
				, 'content'=>$data_url
				))))
			, 'headers'=>$http_response_header
			);
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