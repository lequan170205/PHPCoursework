<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_COOKIE['user_id'])) {
    // Clear everything and redirect to login
    $_SESSION = array();
    if (isset($_COOKIE['user_id'])) {
        setcookie('user_id', '', time() - 3600, '/', '', true, true);
    }
    session_destroy();
    header("Location: login.php");
    exit;
}

// Check if cookie matches session
if ($_SESSION['user_id'] !== $_COOKIE['user_id']) {
    // Clear everything and redirect to login
    $_SESSION = array();
    setcookie('user_id', '', time() - 3600, '/', '', true, true);
    session_destroy();
    header("Location: login.php");
    exit;
}

// Check expiration
if (time() > $_SESSION['login_time'] + 10) {
    // Clear everything and redirect to login
    $_SESSION = array();
    setcookie('user_id', '', time() - 3600, '/', '', true, true);
    session_destroy();
    header("Location: login.php");
    exit;
}
?>