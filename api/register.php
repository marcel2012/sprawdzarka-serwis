<?php
	require_once "main.php";
	if(!filter_var($_GET["email"], FILTER_VALIDATE_EMAIL))
		die('{"query":0,"error":1}');
	if(strlen($_GET["email"])<3)
		die('{"query":0,"error":2}');
	if(strlen($_GET["email"])>50)
		die('{"query":0,"error":3}');
	if(strlen($_GET["pass"])<3)
		die('{"query":0,"error":4}');
	if(strlen($_GET["pass"])>50)
		die('{"query":0,"error":5}');
	if(strlen($_GET["name"])<3)
		die('{"query":0,"error":6}');
	if(strlen($_GET["name"])>15)
		die('{"query":0,"error":7}');
	if(strlen($_GET["surname"])<3)
		die('{"query":0,"error":8}');
	if(strlen($_GET["surname"])>15)
		die('{"query":0,"error":9}');
	/*if(json_decode(http_post ("https://www.google.com/recaptcha/api/siteverify",array("secret"=>"6LdEKzIUAAAAAMbI8JehHalta9UU7jWA1oW7urQu","response"=>$_GET["response"]))["content"])->{"success"}!=1)
		die('{"query":0,"error":10}');*/
	$sql=mysqli_query($mysqli,"INSERT INTO users SET lastlogin=NOW(), md5='', admin=0, class=".intval($_GET["class"]).", surname='".mysqli_real_escape_string($mysqli,$_GET["surname"])."', name='".mysqli_real_escape_string($mysqli,$_GET["name"])."',login='".mysqli_real_escape_string($mysqli,$_GET["email"])."', pass='".password_hash($_GET["pass"], PASSWORD_DEFAULT)."'");
	if(!$sql)
		die('{"query":0,"error":11}');
	else
		die('{"query":1}');
?>
