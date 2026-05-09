<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();

echo json_encode($user);
?>