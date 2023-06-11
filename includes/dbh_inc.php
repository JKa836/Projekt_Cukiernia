<?php

$serverName = "localhost";
$dbUserName = "root";
$dbPasswd = "";
$dbName = "projekt_cukiernia";

$conn = mysqli_connect($serverName,$dbUserName,$dbPasswd,$dbName);

if(!$conn){
    die("Utrata połączenia: ".mysqli_connect_error());
}
return $conn;
?>
