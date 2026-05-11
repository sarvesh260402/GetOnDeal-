<?php
session_start();
include 'config.php';
include 'includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

$csrfEnforce = getenv('CSRF_ENFORCE') === '1';
if (!god_validate_csrf($csrfEnforce)) {
    exit();
}

$user_id = $_SESSION['user_id'] ?? null;
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);

if (!$user_id || $amount === false || $amount <= 0) {
    http_response_code(400);
    echo "Invalid booking request";
    exit();
}

$affiliate_code = isset($_COOKIE['referral_code']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_COOKIE['referral_code']) : null;
$commission = $amount * 0.10;

$insert = $conn->prepare("INSERT INTO bookings (user_id, affiliate_code, amount, commission) VALUES (?, ?, ?, ?)");
$insert->bind_param("isdd", $user_id, $affiliate_code, $amount, $commission);
$insert->execute();
$insert->close();

// update affiliate earnings
if ($affiliate_code) {
    $update = $conn->prepare("UPDATE users SET earnings = earnings + ? WHERE referral_code = ?");
    $update->bind_param("ds", $commission, $affiliate_code);
    $update->execute();
    $update->close();
}

echo "Booking successful";
?>