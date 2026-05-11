<?php

$host = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "";
$password = getenv('DB_PASSWORD') ?: "";
$database = getenv('DB_NAME') ?: "";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

?>