<?php

$serverName = "localhost";
$dbUserName = "root";
$dbPasswd = "";
$dbName = "projekt_cukiernia";

$conn = mysqli_connect($serverName,$dbUserName,$dbPasswd,$dbName);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

return $conn;

?>