<?php
	require_once "main.php";
	session_id($_GET["sessid"]);
	session_start();
	if(!isset($_SESSION["id"]))
		die('{"query":0,"error":-2}');
    $sql=mysqli_query($mysqli,"SELECT id,name,surname FROM users ORDER BY id ASC");
    $sqlz=mysqli_query($mysqli,"SELECT id,name FROM zadanie WHERE ".(!isset($_SESSION["admin"])?"visible=1":"1")." AND groups=".$_SESSION["groups"]." ORDER BY id ASC");
	if(!sql)
		die('{"query":0,"error":-1}');
    echo '{"query":1,"zadania":[';
    $f=false;
    while($row=mysqli_fetch_assoc($sqlz))
    {
		if($f)
			echo ",";
		else
			$f=true;
        echo escape($row["name"]);
    }
    echo '],"users":[';
	$f=false;
	while($row=mysqli_fetch_assoc($sql))
	{
		if($f)
			echo ",";
		else
			$f=true;
        echo '{"name":'.escape($row["name"]." ".$row["surname"]).',"zadania":[';
        $g=false;
        $sq=mysqli_query($mysqli,"SELECT MAX(a.id) as rid FROM request a RIGHT JOIN zadanie b on a.zadanie=b.id AND (a.status=1 OR a.status=3) AND a.user=".$row["id"]." WHERE ".(!isset($_SESSION["admin"])?"b.visible=1":"1")." AND b.groups=".$_SESSION["groups"]." GROUP BY b.id ORDER BY b.id ASC");
        $sum=0;
        $sum2=0;
        while($ro=mysqli_fetch_assoc($sq))
        {
            if($g)
                echo ",";
            else
                $g=true;
            if(is_null($ro["rid"]))
                echo '{"wynik":-1}';
            else
            { 
                $s=mysqli_query($mysqli,"SELECT a.wynik,(SELECT COUNT(*) FROM request WHERE user=a.user AND zadanie=a.zadanie) as s FROM request a WHERE a.id=".$ro["rid"]);
                $r=mysqli_fetch_assoc($s);
                $sum+=$r["wynik"];
                $sum2+=$r["s"];
                echo '{"wynik":'.$r["wynik"].',"id":'.$ro["rid"].',"sum":'.$r["s"].'}';
            }
        }
        echo '],"sum":'.$sum.',"sum2":'.$sum2.'}';
	}
	echo ']}';
?>
