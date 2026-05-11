<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function god_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function god_validate_csrf($enforce = false) {
    $sessionToken = $_SESSION['csrf_token'] ?? null;
    $sentToken = $_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null);

    // Compatibility mode: allow old clients when enforcement is disabled.
    if (!$sentToken && !$enforce) {
        return true;
    }

    if (!$sessionToken || !$sentToken || !hash_equals($sessionToken, $sentToken)) {
        http_response_code(403);
        echo "Invalid CSRF token";
        return false;
    }

    return true;
}
?>
