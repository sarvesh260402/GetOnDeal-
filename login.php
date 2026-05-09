<?php
session_start();
include 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    
    // Save session
    $_SESSION['user_id'] = $user['id'];

    // 🔥 REDIRECT TO DASHBOARD
    header("Location: affiliate-dashboard.php");
    exit();

} else {
    echo "Invalid credentials";
}
?>