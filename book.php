<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];

$affiliate_code = $_COOKIE['referral_code'] ?? null;
$commission = $amount * 0.10;

$sql = "INSERT INTO bookings (user_id, affiliate_code, amount, commission)
VALUES ('$user_id', '$affiliate_code', '$amount', '$commission')";

$conn->query($sql);

// update affiliate earnings
if ($affiliate_code) {
    $conn->query("UPDATE users 
        SET earnings = earnings + $commission 
        WHERE referral_code='$affiliate_code'");
}

echo "Booking successful";
?>