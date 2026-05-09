<?php
include 'config.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Get referral cookie if exists
$ref = $_COOKIE['referral_code'] ?? null;

// Generate unique referral code
$referral_code = substr(md5(time()), 0, 6);

// Check if user exists
$check = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    echo "Email already exists";
    exit;
}

// Insert user
$sql = "INSERT INTO users (name, email, password, referral_code, referred_by)
VALUES ('$name', '$email', '$password', '$referral_code', '$ref')";

if ($conn->query($sql)) {
    header("Location: affiliate-dashboard.html");
} else {
    echo "Error: " . $conn->error;
}
?>