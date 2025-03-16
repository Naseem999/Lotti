<?php
$servername="db4free.net";
$dbUsername="lottinaseem";
$password="sH{QQ]YRoqE)UE%9";
$dbName="lotti";
$port=3306;
$con=new mysqli($servername,$dbUsername,$password,$dbName,$port);

if($con->connect_error){
    die("Connection Failed".$con->connect_error);
}