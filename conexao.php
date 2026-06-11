<?php

$servername = "192.168.15.78";
$username = "nicolas";
$password = "***REMOVED***";
$dbname = "kaerusiteprojeto";

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}   