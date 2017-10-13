<?php
    require_once "../api/main.php";
    $list=glob("../files/data-".intval($_GET["id"])."-*.in");
    usort($list, "sorting");
    for($i=0;$i<sizeof($list);$i++)
        echo str_replace(".in","",str_replace("../files/","",$list[$i])).' ';
?>