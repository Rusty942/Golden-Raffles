<?php

$serverName = "localhost";
$dbUser = "root";
$dbPass = "";
$dBName = "webDevDb";

$connection = mysqli_connect($serverName,$dbUser,$dbPass,$dBName);

if(!$connection){
    die("Connection failes: " . mysqli_connect_error());
}