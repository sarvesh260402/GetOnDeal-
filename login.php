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

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$email || $password === '') {
    http_response_code(400);
    echo "Invalid login request";
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($user && password_verify($password, $user['password'])) {
    
    // Save session
    $_SESSION['user_id'] = $user['id'];

    // 🔥 REDIRECT TO DASHBOARD
    header("Location: affiliate-dashboard.php");
    exit();

} else {
    http_response_code(401);
    echo "Invalid credentials";
}
?>