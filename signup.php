<?php
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

// Get form data
$name = trim($_POST['name'] ?? '');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$rawPassword = $_POST['password'] ?? '';
$password = password_hash($rawPassword, PASSWORD_DEFAULT);

// Get referral cookie if exists
$ref = isset($_COOKIE['referral_code']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_COOKIE['referral_code']) : null;

// Generate unique referral code
$referral_code = substr(md5(time()), 0, 6);

if ($name === '' || !$email || $rawPassword === '') {
    http_response_code(400);
    echo "Invalid signup request";
    exit;
}

// Check if user exists
$check = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
$check->bind_param("s", $email);
$check->execute();
$existsResult = $check->get_result();
if ($existsResult->num_rows > 0) {
    echo "Email already exists";
    $check->close();
    exit;
}
$check->close();

// Insert user
$insert = $conn->prepare("INSERT INTO users (name, email, password, referral_code, referred_by) VALUES (?, ?, ?, ?, ?)");
$insert->bind_param("sssss", $name, $email, $password, $referral_code, $ref);
if ($insert->execute()) {
    header("Location: affiliate-dashboard.html");
} else {
    http_response_code(500);
    echo "Error: " . $insert->error;
}
$insert->close();
?>