<?php

$host = "localhost";
$Username="root";
$Password="kim11";
$DBname="ministation_db";


$conn= mysqli_connect($host, $Username,$Password,$DBname);

if(!$conn){

echo "Cannot connect to database";



}









?>