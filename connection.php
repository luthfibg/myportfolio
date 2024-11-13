<?php

$server = 'localhost';
$username = 'root';
$password = 'mluthfi@MYSQL80';

try {
    $conn = new PDO("mysql:host=$server;dbname=myportfolio", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '';
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>