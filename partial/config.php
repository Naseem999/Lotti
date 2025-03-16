<?php
$servername="localhost";
$dbUsername="root";
$password="";
$dbName="lotti";

$con=new mysqli($servername,$dbUsername,$password,$dbName);

if($con->connect_error){
    die("Connection Failed".$con->connect_error);
}