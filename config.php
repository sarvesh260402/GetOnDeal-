<?php

$host = "localhost";
$username = "u100196670_getondeal";   // your DB username
$password = "GetOnDeal@123";       // replace with your actual password
$database = "u100196670_getondeal";   // your DB name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>